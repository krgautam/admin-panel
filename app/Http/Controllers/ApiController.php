<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Camera;
use App\CameraImage;
use App\UserLocation;
use App\Payment;
use Config;
use Illuminate\Support\Facades\Validator;
class ApiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * return User's Cameras.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function cameras(Request $request)
    {
        $userId = $request->user()->id;
        $cameras = Camera::where(['status'=>1,'user_id'=>$userId])->get();
        return response()->json($cameras, 200);
    }

    public function camera_images(Request $request)
    {
        $userId = $request->user()->id;
        $input = $request->post();
        $rules = [
            'camera_id' => 'required|integer',
            'from_date' => 'required|date_format:Y-m-d H:i:s',
            'to_date' => 'required|date_format:Y-m-d H:i:s'
        ];
        $validator = Validator::make($input, $rules);
            if ($validator->fails()) {
                $response = $validator->messages();
                return response()->json($response, 400);
            }else{
                $cameraImages = CameraImage::where(['status'=>1,'camera_id'=>$input['camera_id']])
                ->whereBetween('created_at',[$input['from_date'],$input['to_date']])->get();
                foreach($cameraImages as $key =>$val){
                    $cameraImages[$key]['path']=asset('/').$val['path'];
                }
                return response()->json($cameraImages, 200);
        }

    }

    public function saveLatLong(Request $request){
        $userId = $request->user()->id;
        $input = $request->post();
        $input['user_id'] = $userId;
        $rules = [
            'lat' => 'required',
            'long' => 'required'
        ];
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $response = $validator->messages();
            return response()->json($response, 400);
        }else{
            $userLocation =UserLocation::create($input);
            return response()->json($userLocation, 200);
    }
    }

    public function payments(Request $request){
        $userId = $request->user()->id;
        $status_id = $request->route('id');
        $payments =  Payment::where(['user_id'=>$userId,'payment_status'=>$status_id])->paginate(10);
        return response()->json($payments, 200);
    }

    public function generateOrder($payment_id){
        try{
        $user = Config::get('constant.paymentCred.token');
        $pass = Config::get('constant.paymentCred.pass');
        $c= date('y');
        $n = $c+1;
        $id_part = str_pad($payment_id, 4, '0', STR_PAD_LEFT);
        $receipt = "OLSS/".$c.'-'.$n.'/'.$id_part;
        $payment =  Payment::findOrFail($payment_id);
        $postData = ["amount"=>(int) $payment->amount,"currency"=>"INR","receipt"=>$receipt,"payment_capture"=>1];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.razorpay.com/v1/orders');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($postData));
        curl_setopt($ch, CURLOPT_USERPWD, $user . ':' . $pass);

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

         $result = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }else{
        $resultArr = json_decode($result,true);
        $order_id=$resultArr['id'];
        $payment->update(['receipent_id'=>$receipt,'order_id'=>$order_id]);
        }
        curl_close($ch);
                return response()->json($resultArr, 200);
            }catch(Exception $e){
                return response()->json(['msg'=>'Something went Wrong'], 500);
            }
    }
    public function savePayment(Request $request){
        $userId = $request->user()->id;
        $input = $request->post();
        $payment_id= $status_id = $request->route('id');
        $rules = [
            'payment_status' => 'required',
            'payment_date' => 'required',
            'transaction_id' =>'required'
        ];
        try{
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $response = $validator->messages();
            return response()->json($response, 400);
        }else{
            $payment =  Payment::findOrFail($payment_id);
            $payment->update($input);
            return response()->json($payment, 200);
    }
}catch(Exception $e){
    return response()->json(['msg'=>'Something went Wrong'], 500);
}
    }
        }
