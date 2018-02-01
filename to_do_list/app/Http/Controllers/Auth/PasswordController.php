<?php

namespace App\Http\Controllers\Auth;
use App\User, Validator, Mail;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */
    // public function passwordChange(Request $request)
    // {
    //    // $validator=Validator::make($request->all(), [
    //    //      'email' => 'required|max:255'  ]);
    //    //  if ($validator->fails()) {
    //    //      return Response::json(['success' => false, 'message'=>implode('<br>', $validator->errors()->all())]);
    //    //      }
    //     $email           = $request->email;
    //     //$email         ='puja.das@cispl.biz';
    //     $subject         ='password reset';
    //     $msg             ='we got a request to reset your password';
    //     $otp             =123;
    //     //$data          =['key' => 123,'first_name'=>'puja'];
    //     $mail            =mail($email,$subject,$msg,$otp);  
    //     if($mail){
    //         // dd('mail sent');
    //         //return redirect('/forgotten_password');
    //         return Response::json(['success' => true, 'message' => 'mail sent.please check']);
    //     }
    //     else{
    //         return Response::json(['success' => false, 'message' => 'Please, check your credentials.']);
    //     }
        //$user = Users::where('email', $request->only('email'))->first();
        //if($email){
         //    $mailing=Mail::send('email\forgetten_password',["data1"=>$data], function ($m) {
         //    $m->from('hello@app.com', 'Your Application');
         //    $m->to("puja.das@cispl.biz", 'name')->subject('email reset!');
           
         // });

        //}

 // dd(Mail::failures());
 //         dd($mailing);
        // $response = Password::sendResetLink($request->only('email'), function (Message $message) {
        // $message->subject($this->getEmailSubject());
        }

    //use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    // public function codeCheck(Request $request){
    //     $otp=$request->otp;
    //     if($otp==123){
    //          return Response::json(['success' => true, 'message' => 'done']);
    //     }
    //     else{
    //         return Response::json(['success' => false, 'message' => 'check your otp']);
    //     }
    // }
   
    public function __construct()
    {
        $this->middleware('guest');
    }
}
