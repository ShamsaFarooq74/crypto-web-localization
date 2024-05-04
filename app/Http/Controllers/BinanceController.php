<?php

namespace App\Http\Controllers;
use App\Notifications\InvoicePaid;
use App\Models\User;
use App\Models\Plan;
use App\Models\Payment;
use App\Models\CustomerTransfer;
use Illuminate\Http\Request;
use Auth,session,DB,Mail;
use App\Mail\SendMail;
use Carbon\Carbon;
use DateTime;
use Notification; 

class BinanceController extends Controller
{
public function BinancePay(Request $request, $id)
{
    // // Generate nonce string
    // $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    // $nonce = '';
    // for ($i = 1; $i <= 32; $i++) {
    //     $pos = mt_rand(0, strlen($chars) - 1);
    //     $char = $chars[$pos];
    //     $nonce .= $char;
    // }

    // $ch = curl_init();
    // $timestamp = round(microtime(true) * 1000);

    // // Request body
    // $requestPayload = array(
    //     "symbol" => "LTCBTC",
    //     "env" => array(
    //         "terminalType" => "APP"
    //     ),
    //     "merchantTradeNo" => mt_rand(982538, 9825382937292),
    //     "orderAmount" => 25.17,
    //     "currency" => "BUSD",
    //     "goods" => array(
    //         "goodsType" => "01",
    //         "goodsCategory" => "D000",
    //         "referenceGoodsId" => "7876763A3B",
    //         "goodsName" => "Ice Cream",
    //         "goodsDetail" => "Greentea ice cream cone"
    //     )
    // );

    // $json_request = json_encode($requestPayload);
    // $payload = $timestamp . "\n" . $nonce . "\n" . $json_request . "\n";
    // $binance_pay_key = "Mlkqann24h9d2NuwcTYpeHOhjIl0t9BSD2QzRPZ6HafdNpLuIkNx2WsiBoBFl2jg";
    // $binance_pay_secret = "FEHhviTXbiMUwDZ79PhQB3XYfxjHwM2BJNb6y8YwKdtCPXFmjYT5hHD33w491Nsj";
    // $signature = strtoupper(hash_hmac('SHA512', $payload, $binance_pay_secret));

    // $headers = array();
    // $headers[] = "Content-Type: application/json";
    // $headers[] = "BinancePay-Timestamp: $timestamp";
    // $headers[] = "BinancePay-Nonce: $nonce";
    // $headers[] = "BinancePay-Certificate-SN: $binance_pay_key";
    // $headers[] = "BinancePay-Signature: $signature";

    // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($request));
    // curl_setopt($ch, CURLOPT_URL, "https://api.binance.com/api/v3/order");
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // curl_setopt($ch, CURLOPT_POST, 1);
    // curl_setopt($ch, CURLOPT_POSTFIELDS, $json_request);

    // $result = curl_exec($ch);
    //     dd($result);
    // if (curl_errno($ch)) {
    //     echo 'Error:' . curl_error($ch);
    // }
    // curl_close($ch);

    // var_dump($result);

    // Redirect user to the payment page

    Payment::create([
            'plan_id'   => $request->id,
            'user_id' => Auth::user()->id,  
        ]);
         session()->flash('alert_success', 'Plan Created Successfully');
        return redirect()->back();
      }

  public function success(Request $request)
  { 
    $user_id = auth()->id();
    $payment = Payment::where('user_id', $user_id)->update([
        'status' => 1
        ]);
}
   public function duration(Request $request){
    $paymentDetails = Payment::with('plan')->get();
    foreach ($paymentDetails as $payment) {
    $duration = $payment->plan->duration;
    $dailyTransferAmount = $payment->plan->daily_transfer_amount;
   
    $createdAt  =  $payment->created_at;
    $currentDate = Carbon::now();

    $difference = $createdAt->diff($currentDate);
    $calculteDays = $difference->d;
    $remaingDays = $duration -=  $calculteDays;
    if($remaingDays > 0)
    {
      
        $transfer = $dailyTransferAmount;
        if($transfer){
        $adminUsers = User::role('admin')->get();
         $PaymentMsg = [
            'title' => 'Notification',
            'body' => 'Daily Transfer Amount Sended Successfully',
        ];
        Notification::send($adminUsers, new InvoicePaid($PaymentMsg));  
        }

         $details = [
            'title' => 'Mail from veronica',
            'body' => 'This is for testing'
        ];
        
       \Mail::to('shamsafarooq24@gmail.com')->send(new SendMail($details));

         CustomerTransfer::create([
            'user_id'   => auth()->user()->id,
            'daily_transfer' =>  $transfer,    

        ]);
            session()->flash('alert_success', 'Transfer Amount Created Successfully');
            return redirect()->back();   


    }  

      


}


  }

  }



