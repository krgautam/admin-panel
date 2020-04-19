<?php

namespace App\Http\Controllers;
use App\Camera;
use App\CameraImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['upload_image']);
        }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function upload_image(Request $request) {
        // getting all of the post data

        $files = $request->file('images');
        $camera_ids = Camera::where(['status'=>1])->pluck('id','original_name');
        $camera_owner_ids = Camera::where(['status'=>1])->pluck('user_id','original_name');
        // Making counting of uploaded images
        $file_count = count($files);

        // start count how many uploaded
        $uploadcount = 0;
        try{
        foreach($files as $file) {
            $rules = array('file' => 'required');

            //'required|mimes:png,gif,jpeg,txt,pdf,doc'

            $validator = Validator::make(array('file'=> $file), $rules);

            if($validator->passes()){
                 $filename = $file->getClientOriginalName();
                 $name_arr = explode('_',$filename);
                 $orig_name= $name_arr[0];
                 if(isset($camera_ids[$orig_name])){
                 $destinationPath = 'uploads/'.$camera_ids[$orig_name].'/';
                 $upload_success = $file->move($destinationPath, $filename);
                 $camera_image= [];
                 $camera_image['name']= $filename;
                 $camera_image['path']= $destinationPath.$filename;
                 $camera_image['user_id']=$camera_owner_ids[$orig_name];
                 $camera_image['camera_id']=$camera_ids[$orig_name];
                 CameraImage::create($camera_image);
                 $uploadcount ++;
                 }
             }
        }
    }catch(Exception $e){
        return ['success'=>false,'error'=>$e->errorMessage()];
    }
    return ['success'=>true,'uploaded_cnt'=>$uploadcount,'total_cnt'=>count($files)];
    }
}
