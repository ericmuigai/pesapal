<?php
/**
 * Created by PhpStorm.
 * User: eric
 * Date: 6/13/14
 * Time: 10:34 AM
 */

namespace Ericmuigai\Pesapal\Oauth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Mail;
use Ericmuigai\Pesapal\Pesapalpayments;
use Illuminate\Support\Facades\Input as Input;

class Ipnlisten {
 public function __construct($consumer_key,$consumer_secret,$statusrequestAPI,$key,$controller,$email,$mail,$name){
// Parameters sent to you by PesaPal IPN
$pesapalNotification=Input::get('pesapal_notification_type');
$pesapalTrackingId=Input::get('pesapal_transaction_tracking_id');
$pesapal_merchant_reference=Input::get('pesapal_merchant_reference');

if($pesapalNotification=="CHANGE" && $pesapalTrackingId!='')
{
$token = $params = NULL;
$consumer = new OAuthConsumer($consumer_key, $consumer_secret);
$signature_method = new OAuthSignatureMethod_HMAC_SHA1();

    //get transaction status
$request_status = OAuthRequest::from_consumer_and_token($consumer, $token, "GET", $statusrequestAPI, $params);
$request_status->set_parameter("pesapal_merchant_reference", $pesapal_merchant_reference);
$request_status->set_parameter("pesapal_transaction_tracking_id",$pesapalTrackingId);
$request_status->sign_request($signature_method, $consumer, $token);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $request_status);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
if(defined('CURL_PROXY_REQUIRED')) if (CURL_PROXY_REQUIRED == 'True')
{
$proxy_tunnel_flag = (defined('CURL_PROXY_TUNNEL_FLAG') && strtoupper(CURL_PROXY_TUNNEL_FLAG) == 'FALSE') ? false : true;
curl_setopt ($ch, CURLOPT_HTTPPROXYTUNNEL, $proxy_tunnel_flag);
curl_setopt ($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
curl_setopt ($ch, CURLOPT_PROXY, CURL_PROXY_SERVER_DETAILS);
}

$response = curl_exec($ch);
$header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
$raw_header  = substr($response, 0, $header_size - 4);
$headerArray = explode("\r\n\r\n", $raw_header);
$header      = $headerArray[count($headerArray) - 1];

//transaction status
$elements = preg_split("/=/",substr($response, $header_size));
$status = $elements[1];
//UPDATE YOUR DB TABLE WITH NEW STATUS FOR TRANSACTION WITH pesapal_transaction_tracking_id $pesapalTrackingId
$payment = Pesapalpayments::where("reference",$pesapal_merchant_reference)->first();
//check if paypent exists we do not want errors on this page
if(count($payment) == 1){
    $payment->status = $status;
    if($payment->tracking_id !=''){
       $payment->tracking_id = $pesapalTrackingId;
    }
    $payment->save();
}
    $controller = $controller;
    //if status is COMPLETE and the controller is not empty
    //then call controller defined by the user to do whatever it has to
    if($status =="COMPLETED" && $controller !=""){
        $obj = new $controller();
        echo $obj->updateItem($key,$pesapal_merchant_reference);
if($mail ==true){
    $data = array(
        'status'=>$status,
        'tracking_id'=>$pesapalTrackingId,
        'reference' =>$pesapal_merchant_reference,
        'name'=>$name
    );
    $user = array(
        'email'=>$email,
        'name'=>$name
    );
    Mail::send('pesapal::payment', $data, function($message) use ($user)
    {
        $message->to($user['email'], $user['name'])
            ->subject('Payment was processed!');
    });
}

    }
    //we do not need to show the pesapal any data if the status is empty
    //so for pesapal to keep querying us when the status changes
if($status   != "PENDING")
{



    $resp="pesapal_notification_type=$pesapalNotification&pesapal_transaction_tracking_id=$pesapalTrackingId&pesapal_merchant_reference=$pesapal_merchant_reference";
    ob_start();
    echo $resp;
    ob_flush();
    exit;
}
}
 }
} 
