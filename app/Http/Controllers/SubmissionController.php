<?php

namespace App\Http\Controllers;

use ZipArchive;
use Carbon\Carbon;
use App\Models\City;
use App\Models\State;
use App\Models\Bakery;
use App\Models\Client;
use App\Models\Country;
use App\Models\Kitchen;
use App\Models\Manager;
use App\Models\Product;
use App\Models\Franchise;
use App\Models\Recruiter;
use App\Models\OrderChild;
use App\Models\Submission;
use App\Models\OrderMaster;
use Illuminate\Http\Request;
use App\Mail\SubmissionAdmin;
use App\Mail\SubmissionCreate;
use App\Mail\SubmissionUpdate;
use App\Exports\SubmissionExport;
use Illuminate\Support\Facades\DB;
use App\Mail\SubmissionAdminUpdate;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $university_file = File::get(public_path('assets/js/universities.json'));
        $city_file = File::get(public_path('assets/js/city.json'));
        $industry_file = File::get(public_path('assets/js/industry.json'));
        $university_courses_file = File::get(public_path('assets/js/university_courses.json'));
        $data['universities'] = json_decode($university_file);
        $data['cities'] = json_decode($city_file);
        $data['industries'] = json_decode($industry_file);
        $data['university_courses'] = json_decode($university_courses_file);

        $data['clients'] = Client::latest()->get();
        $data['managers'] = Manager::latest()->get();
        $data['recruiters'] = Recruiter::latest()->get();
        $data['countries'] = Country::latest()->get();


        return view('submission.create', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id'                  => 'required',
            'role'                       => 'required',
            'full_name'                  => 'required',
            'country'                    => 'required',
            'state'                      => 'required',
            'city'                       => 'required',
            'contact_number'             => 'required|digits_between:8,13',
            'email'                      => 'required|email',
            'client_name'                => 'required',
            'end_client_name'            => 'required',
            'submission_to_client_rate'  => 'required',
            'client_manager_name'        => 'required',
            'acestack_manager_name'      => 'required',
            'recruiter_name'             => 'required',
            'update_by_acestack_manager' => 'required',
            'update_from_client'         => 'required',
            'group_a.*.resume'           => 'required|mimes:pdf,doc,docx',
            'w2_rate' => 'required_if:candidate_status,w2',
            'c2c_rate' => 'required_if:candidate_status,c2c',
            'c2c_employer_name' => 'required_if:candidate_status,c2c',
            'c2c_employer_email' => 'required_if:candidate_status,c2c',
            'c2c_employer_contact' => 'required_if:candidate_status,c2c',
        ], [
            'group_a.*.resume.required' => 'Resume filed is required',
            'group_a.*.resume.mimes' => 'Only pdf and doc files allowed',
        ]);
        $reqData = $request->all();
        $resume_or_other_documents = [];
        foreach ($reqData['group_a'] as $key => $value) {
            $val = collect($value);
            // dd($val);
            $jsonVal = [];
            if ($val['resume']) {
                $image = $val['resume'];
                $dirPath = 'resume/';
                File::isDirectory($dirPath) or File::makeDirectory($dirPath, 0777, true, true);
                $userNameDirPath = public_path($dirPath);
                if (!File::isDirectory($userNameDirPath)) {
                    File::makeDirectory($userNameDirPath, 0777, true, true);
                }
                $name = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                // $path = $val->file('resume')->move(public_path($dirPath), $imageName);
                $path = $val['resume']->move(public_path($dirPath), $imageName);

                // $reqData['image']            = $dirPath . $imageName;
                $jsonVal['resume'] = $dirPath . $imageName;
            }
            $jsonVal['other_documents'] = $val['other_documents'];
            $resume_or_other_documents[] = $jsonVal;
        }

        $manager_mail_id = Manager::where('id', $reqData['acestack_manager_name'])->value('email');
        $recruiter_mail_id = Recruiter::where('id', $reqData['recruiter_name'])->value('email');
        $details = [
            'name' => $reqData['full_name'],
        ];
        try {
            Mail::to($manager_mail_id)->send(new SubmissionCreate($details));
            Mail::to($recruiter_mail_id)->send(new SubmissionCreate($details));
            Mail::to('tpatel@ace-stack.com')->send(new SubmissionAdmin($details));
        } catch (\Throwable $e) {
            return response()->json(['success' => false, 'message' => __('Something is wrong try later.')]);
        }


        $reqData['resume_or_other_documents'] = json_encode($resume_or_other_documents);
        unset($reqData['group_a']);
        Submission::create($reqData);
        return response()->json(['success' => true, 'message' => __('Data added successfully.')]);
        // dd($reqData);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['submission'] = Submission::findOrFail($id);
        $data['clients'] = Client::latest()->get();
        $data['managers'] = Manager::latest()->get();
        $data['recruiters'] = Recruiter::latest()->get();
        $data['countries'] = Country::latest()->get();
        // dd($data['submission']);

        return view('submission.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd('test');
        $validated = $request->validate([
            'client_id'                  => 'required',
            'role'                       => 'required',
            'full_name'                  => 'required',
            'country'                    => 'required',
            'state'                      => 'required',
            'city'                       => 'required',
            'contact_number'             => 'required|digits_between:8,13',
            'email'                      => 'required|email',
            'client_name'                => 'required',
            'end_client_name'            => 'required',
            'submission_to_client_rate'  => 'required',
            'client_manager_name'        => 'required',
            'acestack_manager_name'      => 'required',
            'recruiter_name'             => 'required',
            'update_by_acestack_manager' => 'required',
            'update_from_client'         => 'required',
            // 'group_a.*.resume'           => 'required|mimes:pdf,doc,docx',
            'group_a.*.resume'           => 'mimes:pdf,doc,docx',
            'w2_rate' => 'required_if:candidate_status,w2',
            'c2c_rate' => 'required_if:candidate_status,c2c',
            'c2c_employer_name' => 'required_if:candidate_status,c2c',
            'c2c_employer_email' => 'required_if:candidate_status,c2c',
            'c2c_employer_contact' => 'required_if:candidate_status,c2c',
        ], [
            // 'group_a.*.resume.required' => 'Resume filed is required',
            'group_a.*.resume.mimes' => 'Only pdf and doc files allowed',
        ]);
        $submission = Submission::find($id);
        $reqData = $request->all();
        // dd($reqData);
        $resume_or_other_documents = [];
        foreach ($reqData['group_a'] as $key => $value) {
            $val = collect($value);
            // dd($val);
            $jsonVal = [];

            if (isset($val['resume']) && $val['resume']) {
                $image = $val['resume'];
                $dirPath = 'resume/';
                File::isDirectory($dirPath) or File::makeDirectory($dirPath, 0777, true, true);
                $userNameDirPath = public_path($dirPath);
                if (!File::isDirectory($userNameDirPath)) {
                    File::makeDirectory($userNameDirPath, 0777, true, true);
                }
                $name = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $path = $val['resume']->move(public_path($dirPath), $imageName);
                $jsonVal['resume'] = $dirPath . $imageName;
            } else {
                if (json_decode($submission->resume_or_other_documents)) {
                    foreach (json_decode($submission->resume_or_other_documents) as $item) {
                        if (isset($item->resume)) {
                            $jsonVal['resume'] = $item->resume;
                        }
                    }
                }
            }
            $jsonVal['other_documents'] = $val['other_documents'];
            $resume_or_other_documents[] = $jsonVal;
        }
        // dump($reqData['acestack_manager_name']);
        $manager_mail_id = Manager::where('id', $reqData['acestack_manager_name'])->value('email');
        $recruiter_mail_id = Recruiter::where('id', $reqData['recruiter_name'])->value('email');
        $details = [
            'name' => $reqData['full_name']
        ];
        try {
            Mail::to($manager_mail_id)->send(new SubmissionUpdate($details));
            Mail::to($recruiter_mail_id)->send(new SubmissionUpdate($details));
            Mail::to('tpatel@ace-stack.com')->send(new SubmissionAdminUpdate($details));
        } catch (\Throwable $e) {
            // dd($e);
            return response()->json(['success' => false, 'message' => __('Something is wrong try later.')]);
        }

        // dd('d');
        $reqData['resume_or_other_documents'] = json_encode($resume_or_other_documents);
        unset($reqData['group_a']);
        $submission->update($reqData);
        return response()->json(['success' => true, 'message' => __('Data updated successfully.')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getStates(Request $request)
    {
        $states = State::where('country_id', $request->country_id)->get();
        return response()->json(['status' => true, 'data' => $states]);
    }

    public function getCities(Request $request)
    {
        $states = City::where('state_id', $request->state_id)->get();
        return response()->json(['status' => true, 'data' => $states]);
    }

    public function export()
    {
        return Excel::download(new SubmissionExport, 'submission.xlsx');
    }

    public function zipDownload(Request $request, $id)
    {
        $submission = Submission::find($id);
        $allFiles = json_decode($submission->resume_or_other_documents);
        if ($allFiles) {
            $fileName = 'attachment.zip';
            if (file_exists(public_path($fileName))) {
                File::delete(public_path($fileName));
            }
            $zip = new ZipArchive;
            if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE) {
                foreach ($allFiles as $item) {
                    if ($item->resume && file_exists(public_path($item->resume))) {
                        $relativeName = basename($item->resume);
                        $zip->addFile(public_path($item->resume), $relativeName);
                    }
                }
                $zip->close();
            }
            if (file_exists(public_path($fileName))) {
                return response()->download(public_path($fileName));
            }
            return redirect()->back()->with('error', 'Sorry! No files to download');
        }
    }

    public function SubmissionDashboard()
    {
        // $data['farnchises'] = Franchise::with('city')->groupBy('franchises.city_id')->get();
        // $data['franchises'] = DB::table('franchises')->select(DB::raw('from cities'))->join('cities','franchises.city_id','=','cities.id')->select(DB::raw('count(`franchises`.`city_id`)'),'cities.name')->groupBy(DB::raw('franchises.city_id'))->get();
        
        // SELECT COUNT(`city_id`),`cities`.`name` FROM `franchises`,`cities` WHERE `franchises`.`city_id`=`cities`.`id` GROUP BY `city_id`;
        $data['products'] = Product::count('id');

        return view('submission_dashboard',compact('data'));
    }

    public function submissionByCompanyAjax(Request $request)
    {
        $search = $request->filter;
        $filter = (array)json_decode($search);
        $filter['created_at'] = isset($filter['created_at']) ? $filter['created_at'] : Carbon::now()->format('Y-m-d'); 
        
        $allrecord = Submission::whereDate('created_at', $filter['created_at'])->count();
        $placed = Submission::whereDate('created_at', $filter['created_at'])->where('update_from_client', 'Placed')->count();
        $count = 1;
        $row = [
            [
                'total' => '-',
                'total_submission' => $allrecord,
                'total_placed' => $placed
            ]
        ];

        $data['items'] = $row;
        $data['count'] = $count;
        // dd($data);
        return $data;
    }


    public function submissionByRecruiterAjax(Request $request)
    {
        $search = $request->filter;
        $filter = (array)json_decode($search);
        $filter['created_at'] = isset($filter['created_at']) ? $filter['created_at'] : Carbon::now()->format('Y-m-d'); 
        // dd($filter);
        $sort = $request->sort;
        $order = $request->order;
        $offset = $request->offset;
        $limit = $request->limit;
        // $date = Carbon::now();
        // dd($filter);
        $rows = [];
        
        // $allRecords = Submission::select('recruiter_name')->with('recruiter')->whereDate('created_at', $date)->groupBy('recruiter_name')->get();
        // $allRecords = Submission::select('recruiter_name')->with('recruiter')->whereDate('created_at', $date)->groupBy('recruiter_name')
        $allRecords = Submission::select('recruiter_name')->with('recruiter')->groupBy('recruiter_name')
        ->when($filter, function ($q) use ($filter) {
            // dd($filter);
            foreach ($filter as $key => $item) {
                if ($key == 'created_at') {
                    $q->whereDate('created_at', $item . " 00:00:00");
                }
                else if ($key == 'recruiter_name') {
                    $q->whereHas('recruiter', function ($c) use ($item) {
                        $c->where('name', 'like', '%' . $item . '%');
                    });
                }
            }
        })->get();

        foreach ($allRecords as $key => $item) {
            $d = [];
            $d['recruiter_name'] = $item->recruiter->name;
            $d['total_submissions'] = Submission::where('recruiter_name', $item->recruiter->id)->count();
            $d['total_placements'] = Submission::where([['recruiter_name', $item->recruiter->id], ['update_from_client', 'Placed']])->count();
            $rows[] = $d;
        }        
        $collection = collect($rows);
        $collection->when($filter, function ($q) use ($filter, $collection) {
            foreach ($filter as $key => $item) {
                if ($key == 'total_submissions') {
                    $collection->map(function ($row_item, $key) use ($item, $collection) {
                        if ((int)$row_item['total_submissions'] == (int)$item) {
                            return $row_item;
                        } else {
                            unset($collection[$key]);
                        }
                    });
                }
                else if ($key == 'total_placements') {
                    $collection->map(function ($row_item, $key) use ($item, $collection) {
                        if ((int)$row_item['total_placements'] == (int)$item) {
                            return $row_item;
                        } else {
                            unset($collection[$key]);
                        }
                    });
                }
            }
        });
        $rows = collect($collection->values()->all());

        $rows = $rows->toArray();
        $data['items'] = $rows;
        $data['count'] = count($rows);
        return $data;
    }
}
