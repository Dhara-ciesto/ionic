<?php

namespace App\Http\Controllers;

use Log;
use Illuminate\Http\Request;
use App\Models\FragranceTone;
use Illuminate\Validation\ValidationException;

class FragranceToneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('fragrance_tone.index');
    }

    /**
     * Display a listing of the resource.
     * 
     * @param Request $request
     * @return \Illuminate\Http\Response
     * 
     */
    public function logsServerSideOwn(Request $request)
    {
        $search = $request->filter;
        $filter = (array)json_decode($search);
        $sort = $request->sort;
        $order = $request->order;
        $offset = $request->offset;
        $limit = $request->limit;
        $i = 1;

        // your table name 
        $query = FragranceTone::when($search, function ($q) use ($filter, $i) {
            foreach ($filter as $key => $item) {
                if ($key == 'status') {
                    if (strtolower($item) == 'active') {
                        $q->where($key, 1);
                    } else {
                        $q->where($key, 0);
                    }
                } else {
                    $q->where($key, 'Like', '%'.$item.'%');
                }
            }
        })->when($sort, function ($q1) use ($sort, $order) {
            if ($sort == 'counter') {
                $q1->orderBy('id', $order);
            } else {
                $q1->orderBy($sort, $order);
            }
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
        foreach ($row as $key => $item) {
            $row[$key]['counter'] = $index++;
            $row[$key]['video'] = '<a href="'.asset($item['video']).'" target="_blank">'.str_replace('/video/fragrance_tone/','',$item['video']).'</a>';
        }
        $data['items'] = $row;
        $data['count'] = $count;
        // dd($data);
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fragrance_tone.create');
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
            'name' =>  'required|unique:fragrance_tones,name',
            'tone_binary_digit.*' => 'required|alpha_num',
            'video' => 'required|file|max:20000'
        ],[ 
            'name.required' => 'Please Enter FragranceTone name',
            'name.unique' => 'FragranceTone name has already been taken.',
            'tone_binary_digit.*.required' => 'Please enter Tone binary digit',
            'tone_binary_digit.*.alpha_num' => 'Tone binary digit may only contain letters and numbers.'
        ]);
        $reqData = $request->all();
        if ($request->file('video')) {
            $video = $request->file('video');
            $extension = $video->getClientOriginalExtension();
            if(!in_array($extension,['mp4','gif'])){
                throw ValidationException::withMessages(['video' => 'You can only upload mp4 or gif files']);
            }
            $filename = time() . '.' . $video->getClientOriginalExtension();
            $avatarPath = public_path('/video/fragrance_tone');
            $video->move($avatarPath, $filename);
            $reqData['video'] = '/video/fragrance_tone/' . $filename;
        }
        $reqData['tone_binary_digit'] =  '0x'.implode(' 0x',$reqData['tone_binary_digit']);
        FragranceTone::create($reqData);
        Log::info('Fragrance Tone Created');
        return redirect()->route('fragrance_tone.index')->with('success', 'Fragrance Tone created successfully');
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['tone'] = FragranceTone::findOrFail($id);
        return view('fragrance_tone.edit', $data);
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
        $validated = $request->validate([
            'name' => 'required|unique:fragrance_tones,name,'.$id,
            'tone_binary_digit.*' => 'required|alpha_num',
            'video' => 'file|max:20000'
        ],[ 
            'name.required' => 'Please Enter Fragrance Tone name',
            'name.unique' => 'FragranceTone name has already been taken.',
            'tone_binary_digit.*.required' => 'Please enter Tone binary digit',
            'tone_binary_digit.*.alpha_num' => 'Tone binary digit may only contain letters and numbers.',
            // 'video.size' => 'Tone binary dffrs and numbers.'
        ]);
        $reqData = $request->all();
        if ($request->file('video')) {
            $video = $request->file('video');
            // dd($video->getClientMimeType());
            $extension = $video->getClientOriginalExtension();
            if(!in_array($extension,['mp4','gif'])){
                throw ValidationException::withMessages(['video' => 'You can only upload mp4 or gif files']);
            }
            $filename = time() . '.' . $video->getClientOriginalExtension();
            $avatarPath = public_path('/video/fragrance_tone');
            $video->move($avatarPath, $filename);
            $reqData['video'] = '/video/fragrance_tone/' . $filename;
        }
        $reqData['tone_binary_digit'] = '0x'.implode(' 0x',$reqData['tone_binary_digit']);
        $tone = FragranceTone::findOrFail($id);
        $tone->update($reqData);
        \Log::info('Fragrance Tone having id '. $id.' Updated');
        return redirect()->route('fragrance_tone.index')->with('success', 'Fragrance Tone updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FragranceTone::find($id)->delete();
        \Log::info('Fragrance Tone having id '. $id.' Deleted');
        return response()->json(['success' => true, 'message' => 'Fragrance Tone deleted successfully']);
    }
}
