<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index(){

        $data['medias'] = Media::get()->all();
        return view('media.index',$data);
    }
    public function create(){

        return view('media.create');
    }
    public function store(Request $request){

        $request->validate(['image.*' => 'required']);
        foreach ($request->file('image') as $photo) {
            # code...
            if ($photo) {
                $filename = time() . '.' . $photo->getClientOriginalExtension();
                $avatarPath = public_path('/images/product');
                $photo->move($avatarPath, $filename);
                $image = '/images/product/' . $filename;
                Media::create(['image' => $image]);
            }
        }
        \Log::info('Image Uploaded in Media');
        return redirect()->route('media.index')->with('success', 'Media image uploaded successfully');
    }
     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Media::find($id)->delete();
        \Log::info('Media having id '. $id.' Deleted');
        return response()->json(['success' => true, 'message' => 'Media deleted successfully']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroySelected(Request $request)
    {
        $ids = $request->ids;
        Media::whereIn('id', explode(",", $ids))->delete();
        \Log::info('Media with ids ' . $request->ids . ' Deleted ');
        return response()->json(['success' => "Media Deleted successfully."]);
    }

}
