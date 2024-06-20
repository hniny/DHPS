<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class KpayController extends Controller
{

    private $appid='kpcd12d5c51b934d7692f2175be85194';
    private $key='e3a4c994c0b52e975ef93d4240633f48';
    private $callback='https://webapplication.dhps.com.mm/kbzCallBack';
    private $merch_code='200130';
    private $nonce_str='232323233';  
    private $timeout='100m';   
   

    public function kpay(){
       return view('kpay.payment');
    }
    public function pwaKpay(){
             $time=time();
        $merch_order_id=(string)rand();       
        $timestamp=strval($time);
        // dd($timestamp);
        // $trade_type=$request['trade_type']; 
        $trade_type="PWAAPP";
        $req_amt='1000';
        $title='iPhoneX';
       
        $sign1 = 'appid='.$this->appid.'&callback_info=title%3diphonex&merch_code='.$this->merch_code.'&merch_order_id='.$merch_order_id.'&method=kbz.payment.precreate&nonce_str='.$this->nonce_str.'&notify_url='.$this->callback.'&timeout_express='.$this->timeout.'&timestamp='.$timestamp.'&title='.$title.'&total_amount='.$req_amt.'&trade_type=PWAAPP&trans_currency=MMK&version=1.0&key='.$this->key;
      
        $sign1 = hash('sha256', $sign1);
        $sign1 = strtoupper($sign1);   
                      
        $response = Http::post('http://api.kbzpay.com/payment/gateway/uat/precreate', 
        [
            "Request" => [
               "timestamp" => $timestamp,
               "method"=> "kbz.payment.precreate",
               "notify_url"=> $this->callback,
               "nonce_str"=> $this->nonce_str,              
               "sign_type"=>"SHA256",
               "sign"=>  $sign1,
               "version"=> "1.0",
               "biz_content"=> [
                  "merch_order_id" => $merch_order_id, 
                  "merch_code" =>  $this->merch_code, 
                  "appid" =>  $this->appid,                
                  "trade_type" => $trade_type,
                  "title" =>  "iPhoneX", 
                  "total_amount" =>  $req_amt,   
                  "trans_currency" => "MMK",              
                  "timeout_express" => $this->timeout,                 
                  "callback_info" =>  "title%3diphonex",
                ]
            ]
        ]);
        // dd($response);
        $data=$response->json();   
       // dd($data);    
      
        $prepay_id=$data['Response']['prepay_id'];  
        $sign=  $data['Response']['sign'];   
        // dd($sign);   
   

            //$nonce_str = $this->generateRandomString();   

        $sign2= 'appid='.$this->appid.'&merch_code='.$this->merch_code.'&nonce_str='.$this->nonce_str.'&prepay_id='.$prepay_id.'&timestamp='.$timestamp.'&key='.$this->key;

        $sign2 = hash('sha256', $sign2);    
        $sign2 = strtoupper($sign2);   
		  //dd($sign2);
     
         //  $result='https://static.kbzpay.com/pgw/pwa/#/?appid='.$this->appid.'&merch_code='.$this->merch_code.'&nonce_str='.$this->nonce_str.'&prepay_id='.$prepay_id.'&timestamp='.$timestamp.'&sign='.$sign2;          
		$result='https://static.kbzpay.com/pgw/uat/pwa/#/?appid='.$this->appid.'&merch_code='.$this->merch_code.'&nonce_str='.$this->nonce_str.'&prepay_id='.$prepay_id.'&timestamp='.$timestamp.'&sign='.$sign2;        
          

        return view('kpay.pwaKpay',compact('result'));

        
    }
    public function preCreate(Request $request){
        $time=time();
        $merch_order_id=(string)rand();       
        $timestamp=strval($time);
        $trade_type=$request['trade_type'];
        $req_amt='1000';
        $title='iPhoneX';
        $sign1 = 'appid='.$this->appid.'&callback_info=title%3diphonex&merch_code='.$this->merch_code.'&merch_order_id='.$merch_order_id.'&method=kbz.payment.precreate&nonce_str='.$this->nonce_str.'&notify_url='.$this->callback.'&timeout_express='.$this->timeout.'&timestamp='.$timestamp.'&title='.$title.'&total_amount='.$req_amt.'&trade_type=PAY_BY_QRCODE&trans_currency=MMK&version=1.0&key='.$this->key;
        $sign1 = hash('sha256', $sign1);
        $sign1 = strtoupper($sign1);

        $response = Http::post('http://api.kbzpay.com/payment/gateway/uat/precreate', 
        [
            "Request" => [
               "timestamp" => $timestamp,
               "notify_url"=> $this->callback,
               "nonce_str"=> $this->nonce_str,
               "method"=> "kbz.payment.precreate",
               "sign_type"=>"SHA256",
               "sign"=>  $sign1,
               "version"=> "1.0",
               "biz_content"=> [
                  "appid" =>  $this->appid,
                  "merch_code" =>  $this->merch_code,
                  "merch_order_id" => $merch_order_id,  
                  "trade_type" => $trade_type,
                  "total_amount" =>  $req_amt,
                  "title" =>  "iPhoneX", 
                  "timeout_express" => $this->timeout,
                  "trans_currency" => "MMK",
                  "callback_info" =>  "title%3diphonex",
                ]
            ]
        ]);
  
        $data=$response->json();  
        // dd($data);
        $prepay_id=$data['Response']['prepay_id'];        
        $qrCode=$data['Response']['qrCode'];
        $mr_order_id=$data['Response']['merch_order_id'];
        return view('kpay.kpayPrecreate',compact('data','qrCode','prepay_id','req_amt'));
      
    }
     
    public function kpayPaymentProcess(Request $request){
     
        Log::info($req->all());
		   return 'success';

    }
	public function pwaPaymentProcess(Request $request){
		Log::info($request->all());
        return 'success';      

    }
	 public function generateRandomString($length = 40) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
  
   
    
}
