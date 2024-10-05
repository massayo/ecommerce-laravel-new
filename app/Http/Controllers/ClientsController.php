<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientsController extends Controller
{
    public function paymentMethods()
    {
        $pMethods = PaymentMethod::orderby("payment_name","asc")
             ->select('id','payment_name')
             ->get();

        return response()->json($pMethods);
    }

    public function paymentMethodsGuest()
    {
        $pMethods = PaymentMethod::orderby("payment_name","asc")
             ->select('id','payment_name')
             ->get();

        return response()->json($pMethods);
    }

    public function saveClient(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:clients,username',
            'email' => 'required|email|unique:clients,email',
            'card_number'=> 'integer|max_digits:20',
            'cvc'=> 'integer|max_digits:5', 
        ]);

        $client = Client::create([
            'name' => $request->name,
            'email' =>  $request->email,
            'username' =>  $request->username,
            'password' => Hash::make($request->password),
            'gender' =>  $request->seller_gender,
            'address' =>  ($request->city." ".$request->state),
            'payment_method_id' =>  $request->payment_method_id,
            'card_number' =>  $request->card_number,
            'cvc' =>  $request->cvc,
            'exp_month' =>  $request->month,
            'exp_year' =>  $request->year
        ]);

        if($client)
        {
            //Get seller details
            $client = Client::where('email',$request->email)->first();

            $data = array(
                'new_password'=>$request->password,
                'client'=>$client
            );   
    
            $mail_body = view('email-templates.client-registration',$data)->render();

            $mailConfig = array(
                'mail_from_email' => env('EMAIL_FROM_ADDRESS'),
                'mail_from_name' => env('EMAIL_FROM_NAME'),
                'mail_recipient_email' =>$client->email,
                'mail_recipient_name' => $client->name,
                'mail_subject' => 'Login credentials',
                'mail_body' => $mail_body
            );
            
            if(sendEmail($mailConfig)){
                
            }
            else{
                
            }
        }

        //return view('back.pages.seller.auth.login');
        session()->flash('success','Login data sent to your email. Use them to login!');
        return redirect()->route('client.login');
    }

    public function loginHandler(Request $request)
    {
        $fieldType = filter_var($request->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if($fieldType == 'email') {
             $request->validate(
                [
                   'login_id' => 'required|email|exists:clients,email',
                   'password' => 'required|min:5|max:45'
                ],
                [
                    'login_id.required' => 'Email or Username is required',
                    'login_id.email' => 'Invalid email address',
                    'login_id.exists' => 'Email is not in our system',
                    'password.required' => 'Password is required'
                ]
                );
        }
        else {
            $request->validate(
                [
                   'login_id' => 'required|exists:clients,username',
                   'password' => 'required|min:5|max:45'
                ],
                [
                    'login_id.required' => 'Email or Username is required',
                    'login_id.exists' => 'Username is not in our system',
                    'password.required' => 'Password is required'
                ]
            );
        }

        $creds = array (
            $fieldType => $request->login_id,
            'password' => $request->password
        );

        if(Auth::guard('client')->attempt($creds)){
             return redirect()->route('client.home');
        }
        else{
            session()->flash('fail', 'Incorrect credentials');
            return redirect()->route('client.login');
        }

    }
}
