<?php

namespace App\Http\Controllers;

use App\Exports\DashboardExport;
use App\Models\Client;
use App\Models\Country;
use App\Models\Manager;
use App\Models\PrivacyPolicy;
use App\Models\Profile;
use App\Models\Recruiter;
use App\Models\Submission;
use App\Models\TermsAndCondition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('submission.dashboard');
        $data['clients'] = Client::latest()->get();
        $data['managers'] = Manager::latest()->get();
        $data['recruiters'] = Recruiter::latest()->get();
        $data['countries'] = Country::latest()->get();
        
        return view('frontend.index', $data);
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
            'agree'                             => 'required',
            'name'                              => 'required',
            'phone'                             => 'required',
            'email'                             => 'email|unique:profiles,email',
            'video'                             => 'mimes:mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts',
            'image'                             => 'image|mimes:jpeg,png,jpg,gif,svg',
            'cv'                                => 'mimes:pdf,doc',
            'group_a.*.university'              => 'required',
            'group_a.*.degree'                  => 'required',
            'group_a.*.grades_achieved'         => 'required',
            // 'group_b.*.education_institutional' => 'required',
            // 'group_b.*.education_level'         => 'required',
            // 'group_b.*.grades_achieved2'        => 'required',
            // 'group_c.*.other_qualification'     => 'required',
            'group_d.*.city'                    => 'required',
            'group_d.*.industry'                => 'required',
        ], [
            'group_a.*.university.required'              => 'The university field is required',
            'group_a.*.degree.required'                  => 'The degree field is required',
            'group_a.*.grades_achieved.required'         => 'The grades achieved field is required',
            // 'group_b.*.education_institutional.required' => 'The educational institution field is required',
            // 'group_b.*.education_level.required'         => 'The educational level field is required',
            // 'group_b.*.grades_achieved2.required'         => 'The grades achieved field is required',
            // 'group_c.*.other_qualification.required'     => 'The other qualification field is required',
            'group_d.*.city.required'                    => 'The city field is required',
            'group_d.*.industry.required'                => 'The industry field is required',
        ]);
        $reqData             = $request->all();
        $university          = [];
        $education           = [];
        // $other_qualification = [];
        $roles               = [];
        foreach ($reqData['group_a'] as $key => $value) {
            $university[] = $value;
        }
        // foreach ($reqData['group_b'] as $key => $value) {
        //     $education[] = $value;
        // }
        // foreach ($reqData['group_c'] as $key => $value) {
        //     $other_qualification[] = $value;
        // }
        foreach ($reqData['group_d'] as $key => $value) {
            $roles[] = $value;
        }
        $reqData['university']          = json_encode($university);
        $reqData['education']           = json_encode($education);
        // $reqData['other_qualification'] = json_encode($other_qualification);
        $reqData['roles']               = json_encode($roles);

        if ($request->hasFile('image')) {
            $image = $request->image;
            $dirPath = 'images/profile/';
            File::isDirectory($dirPath) or File::makeDirectory($dirPath, 0777, true, true);
            $userNameDirPath = public_path($dirPath);
            if (!File::isDirectory($userNameDirPath)) {
                File::makeDirectory($userNameDirPath, 0777, true, true);
            }
            $name = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $path = $request->file('image')->move(public_path($dirPath), $imageName);

            $reqData['image']            = $dirPath . $imageName;
        }
        if ($request->hasFile('video')) {
            $image = $request->video;
            $dirPath = 'videos/profile/';
            File::isDirectory($dirPath) or File::makeDirectory($dirPath, 0777, true, true);
            $userNameDirPath = public_path($dirPath);
            if (!File::isDirectory($userNameDirPath)) {
                File::makeDirectory($userNameDirPath, 0777, true, true);
            }
            $name = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $path = $request->file('video')->move(public_path($dirPath), $imageName);

            $reqData['video']            = $dirPath . $imageName;
        }
        if ($request->hasFile('cv')) {
            $image = $request->cv;
            $dirPath = 'documents/profile/';
            File::isDirectory($dirPath) or File::makeDirectory($dirPath, 0777, true, true);
            $userNameDirPath = public_path($dirPath);
            if (!File::isDirectory($userNameDirPath)) {
                File::makeDirectory($userNameDirPath, 0777, true, true);
            }
            $name = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $path = $request->file('cv')->move(public_path($dirPath), $imageName);

            $reqData['cv']            = $dirPath . $imageName;
        }

        unset($reqData['group_a']);
        // unset($reqData['group_b']);
        unset($reqData['group_c']);
        unset($reqData['group_d']);
        Profile::create($reqData);
        // return redirect()->route('home')->with('success', 'Profile created successfully.');
        return response()->json(['success' => true, 'message' => __('Profile created successfully.')]);
    }

    public function profile_listing(Request $request)
    {
        $data['data'] = Profile::get();
        $university_file = File::get(public_path('assets/js/universities.json'));
        $city_file = File::get(public_path('assets/js/city.json'));
        $industry_file = File::get(public_path('assets/js/industry.json'));
        $university_courses_file = File::get(public_path('assets/js/university_courses.json'));
        $data['universities'] = json_decode($university_file);
        $data['cities'] = json_decode($city_file);
        $data['industries'] = json_decode($industry_file);
        $data['university_courses'] = json_decode($university_courses_file);

        // $data['submissions'] = Submission::with('country_obj', 'state_obj', 'city_obj', 'client', 'manager', 'recruiter')->latest()->get();
        // dd($data['submissions']);
        return view('submission_listing', $data);
    }

    public function submissionAjax(Request $request)
    {
        // dd($request->all());
        $search = $request->filter;
        $filter = (array)json_decode($search);
        $sort = $request->sort;
        $order = $request->order;
        $offset = $request->offset;
        $limit = $request->limit;
        $i = 1;
        // dd($request->all());

        $query = Submission::with('country', 'state', 'city', 'client', 'manager', 'recruiter')->when($search, function ($q) use ($filter, $i) {
            DB::enableQueryLog();

            foreach ($filter as $key => $item) {
                
                if (is_string($item)) {
                    $q->where($key, $item);
                } else {
                    foreach ($item as $item_key => $val) {
                        if ($item_key == 'cv') {
                            if ($val == 'yes') {
                                $q->whereNotNull('cv');
                            } else if ($val == 'no') {
                                $q->whereNull('cv');
                            }
                        } else {
                            foreach ($item as $item_key => $value) {
                                $q->where($item_key, 'like', '%' . $value . '%');
                            }
                        }
                    }
                }
            }
        })->when($sort, function ($q1) use ($sort, $order) {
            $q1->orderBy($sort, $order);
        });
        if (!$sort) {
            $query->orderBy('created_at', 'desc');
        }
        $count =  $query->count();
        $row = $query->when($offset, function ($q) use ($offset) {
            $q->offset($offset);
        })->when($limit, function ($q) use ($limit) {
            $q->limit($limit);
        })->get()->toArray();
        $index = $offset + 1;
        $data = [];
        // dd(DB::getQueryLog());
        
        $data['items'] = $row;
        $data['count'] = $count;
        // dd($data);
        return $data;
    }

    public function profile_listing_old(Request $request)
    {
        $data['data'] = Profile::get();
        $university_file = File::get(public_path('assets/js/universities.json'));
        $city_file = File::get(public_path('assets/js/city.json'));
        $industry_file = File::get(public_path('assets/js/industry.json'));
        $university_courses_file = File::get(public_path('assets/js/university_courses.json'));
        $data['universities'] = json_decode($university_file);
        $data['cities'] = json_decode($city_file);
        $data['industries'] = json_decode($industry_file);
        $data['university_courses'] = json_decode($university_courses_file);
        // dd($data['universities']);
        return view('profile_listing', $data);
    }

    public function logsServerSideOwn(Request $request)
    {
        // dd($request->all());
        $search = $request->filter;
        $filter = (array)json_decode($search);
        $sort = $request->sort;
        $order = $request->order;
        $offset = $request->offset;
        $limit = $request->limit;
        $i = 1;
        // dd($request->all());

        $query = Profile::when($search, function ($q) use ($filter, $i) {
            DB::enableQueryLog();

            foreach ($filter as $key => $item) {
                // dump($key);
                // dump($item);
                if(is_string($item)) {
                    $q->where($key, $item);
                } else {
                    foreach ($item as $item_key => $val) {
                        if($item_key == 'cv') {
                            if ($val == 'yes') {
                                $q->whereNotNull('cv');
                            } else if ($val == 'no') {
                                $q->whereNull('cv');
                            }
                        } else {
                            foreach ($item as $item_key => $value) {
                                $q->where($item_key, 'like', '%' . $value . '%');
                            }
                        }
                    }
                }
                
                // dump(explode(',', $item));
                // if(is_string($item)) {
                //     // if($key == 'education_institutional') {
                //     //     foreach (explode(',', $item) as $value) {
                //     //         $q->where('education', 'like', '%'. $value.'%');
                //     //     }
                //     // } else if($key == 'degree') {
                //     //     foreach (explode(',', $item) as $value) {
                //     //         $q->where('university', 'like', '%'. $value.'%');
                //     //     }
                //     // } else {
                //         // $q->where($key, $item);
                //         // }
                //     // foreach (explode(',', $item) as $value) {
                //     //     $q->where($key, 'like', '%'. $value.'%');
                //     // }
                    
                // } else {
                //     foreach ($item as $columnName => $filterValues) {
                //         if ($columnName == 'cv') {
                //             if($filterValues == 'yes') {
                //                 $q->whereNotNull('cv');
                //             } else if($filterValues == 'no') {
                //                 $q->whereNull('cv');
                //             }
                //         } else {
                //             foreach (explode(',', $filterValues) as $value) {
                //                 $q->where($columnName, 'like', '%'. $value.'%');
                //             }
                //         }
                //     }
                // }
            }
        })->when($sort, function ($q1) use ($sort, $order) {
            $q1->orderBy($sort, $order);
        });
        if (!$sort) {
            $query->orderBy('created_at', 'desc');
        }
        $count =  $query->count();
        $row = $query->when($offset, function ($q) use ($offset) {
            $q->offset($offset);
        })->when($limit, function ($q) use ($limit) {
            $q->limit($limit);
        })->get()->toArray();
        $index = $offset + 1;
        $data = [];
        // dd(DB::getQueryLog());
        foreach ($row as $key => $item) {
            $universityArr = [];
            $degreeArr = [];
            foreach (json_decode($item['university']) as $university) {
                $degreeArr[] = $university->degree;
            }
            foreach (json_decode($item['education']) as $university) {
                $universityArr[] = $university->education_institutional;
            }
            // dump($universityArr);
            // foreach ($universityArr as $item) {
            //     $row[$key]['education_institutional'] = $item;
            // }
            // foreach ($degreeArr as $item) {
            //     $row[$key]['degree'] = $item;
            // }
            $row[$key]['education'] = implode(',', $universityArr);
            $row[$key]['university'] = implode(',', $degreeArr);
        }

        $data['items'] = $row;
        $data['count'] = $count;
        return $data;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['profile'] = Profile::findOrFail($id);
        // dd($data['profile']);
        return view('view_profile_new', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

    public function export()
    {
        return Excel::download(new DashboardExport, 'profile-data.xlsx');
    }

    public function privacyPolicy(Request $request)
    {
        $data['privacyPolicy'] = PrivacyPolicy::find(1);
        return view('privacyPolicy', $data);
    }
    public function paymentPlan(Request $request)
    {
        return view('paymentPlan');
    }
    public function termsAndConditions(Request $request)
    {
        $data['termsAndCondition'] = TermsAndCondition::find(1);
        return view('termsAndConditions', $data);
    }
}
