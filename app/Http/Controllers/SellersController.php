<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use constGuards;
use constDefaults;
use App\Models\Seller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class SellersController extends Controller
{
    public function loginHandler(Request $request)
    {
        $fieldType = filter_var($request->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if($fieldType == 'email') {
             $request->validate(
                [
                   'login_id' => 'required|email|exists:sellers,email',
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
                   'login_id' => 'required|exists:sellers,username',
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

        if(Auth::guard('seller')->attempt($creds)){
             return redirect()->route('seller.home');
        }
        else{
            session()->flash('fail', 'Incorrect credentials');
            return redirect()->route('seller.login');
        }

    }

    public function sendPasswordResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:sellers,email'
        ],
        [
            'email.required' => 'Email is required',
            'email.email' => 'Invalid email address',
            'email.exists' => 'Email is not in our system'
        ]);

        //Get seller details
        $seller = Seller::where('email',$request->email)->first();

        //Generate token
        $token = base64_encode(Str::random(64));

        //Check if there is an existing reset password token
        $oldToken = DB::table('password_reset_tokens')
                      ->where(['email'=>$request->email,'guard'=>constGuards::SELLER])
                      ->first();

        if($oldToken)
        {
            DB::table('password_reset_tokens')
              ->where(['email'=>$request->email,'guard'=>constGuards::SELLER])
              ->update([
                'token' => $token,
                'created_at' => Carbon::now()
              ]);
        }
        else{
            DB::table('password_reset_tokens')->insert([
                'email' => $request->email,
                'guard'=>constGuards::SELLER,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
        }

        //Create action link
        $actionLink = route('seller.reset-password',['token'=>$token, 'email'=>$request->email]);
        
        $data = array(
            'actionLink'=>$actionLink,
            'seller'=>$seller
        );   

        $mail_body = view('email-templates.seller-forgot-email-template',$data)->render();

        $mailConfig = array(
            'mail_from_email' => env('EMAIL_FROM_ADDRESS'),
            'mail_from_name' => env('EMAIL_FROM_NAME'),
            'mail_recipient_email' =>$seller->email,
            'mail_recipient_name' => $seller->name,
            'mail_subject' => 'Reset Password',
            'mail_body' => $mail_body
        );
        
        if(sendEmail($mailConfig)){
             session()->flash('success','We have e-mailed your password reset link');
        }
        else{
            session()->flash('fail','Something went wrong!');
        }
        return redirect()->route('seller.forgot-password');

    }

    public function resetPassword(Request $request, $token = null)
    {
        $check_token = DB::table('password_reset_tokens')
                         ->where(['token' => $token, 'guard'=>constGuards::SELLER])
                         ->first();
        
        if($check_token){
             $diffMins = Carbon::createFromFormat('Y-m-d H:i:s', $check_token->created_at)->diffInMinutes(Carbon::now());
             if($diffMins > constDefaults::tokenExpiredMinutes)
             {
                session()->flash('fail','Token expired!, request another reset password link');
                return redirect()->route('seller.forgot-password', ['token' => $token]);
             }
             else{
                return view('back.pages.seller.auth.reset-password')->with(['token' => $token]);
             }
        }
        else{
            session()->flash('fail','Invalid token!, request another reset password link');
            return redirect()->route('seller.forgot-password', ['token' => $token]);
        }
    }

    public function resetPasswordHandler(Request $request)
    {
        $request->validate([
            'new_password' => 'required|min:5|max:45|required_with:new_password_confirmation|
            same:new_password_confirmation',
            'new_password_confirmation'=>'required'
        ]);

        $token = DB::table('password_reset_tokens')
                   ->where(['token' => $request->token, 'guard'=>constGuards::SELLER])
                   ->first();
        //get seller details
        $seller = Seller::where('email',$token->email)->first();
        //update seller password
        Seller::where('email', $seller->email)->update([
            'password' => Hash::make($request->new_password)
        ]);
        //delete token record
        DB::table('password_reset_tokens')
            ->where([
                'email' =>$seller->email,
                'token' => $request->token, 
                'guard'=>constGuards::SELLER])
            ->delete();

            $data = array(
                'new_password'=>$request->new_password,
                'seller'=>$seller
            );   
    
            $mail_body = view('email-templates.seller-reset-email-template',$data)->render();
    
            $mailConfig = array(
                'mail_from_email' => env('EMAIL_FROM_ADDRESS'),
                'mail_from_name' => env('EMAIL_FROM_NAME'),
                'mail_recipient_email' =>$seller->email,
                'mail_recipient_name' => $seller->name,
                'mail_subject' => 'Password changed',
                'mail_body' => $mail_body
            );

            sendEmail($mailConfig);
            return redirect()->route('seller.login')->with('success','Done!, your password was changed, use new password to login');
    
    }

    public function logoutHandler(Request $request)
    {
        Auth::guard('seller')->logout();
        session()->flash('fail','You are logged out!');
        return redirect()->route('seller.login');
    }

    public function profileView(Request $request)
    {
        $seller = null;
        if(Auth::guard('seller')->check()){
            $seller = Seller::findOrFail(auth()->id());
        }

        $payment_methods = PaymentMethod::all();

        return view('back.pages.seller.profile', compact('seller','payment_methods'));
    }

    public function changeProfilePicture(Request $request)
    {
         $seller = Seller::findOrFail(auth('seller')->id());
         $path = 'images/users/sellers/';
         $file = $request->file('sellerProfilePictureFile');
         $old_picture = $seller->getAttributes()['picture'];
         $file_path = $path.$old_picture;
         $filename = 'SELLER_IMG'.round(2,1000).$seller->id.time().uniqid().'.jpg';

         $upload = $file->move(public_path($path),$filename);

         if($upload){
            if($old_picture != null && File::exists(public_path($path.$old_picture)))
            {
                File::delete(public_path($path.$old_picture));
            }
            $seller->update(['picture'=>$filename]);
            return response()->json(['status'=>1, 'msg'=>'Profile image successfully updated!']);
         }
         else{
            return response()->json(['status'=>0, 'msg'=>'Something went wrong!']);
         }
    }

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

    public function saveSeller(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:sellers,username',
            'email' => 'required|email|unique:sellers,email',
            'card_number'=> 'integer|max_digits:20',
            'cvc'=> 'integer|max_digits:5', 
        ]);

        $seller = Seller::create([
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

        if($seller)
        {
            //Get seller details
            $seller = Seller::where('email',$request->email)->first();

            $data = array(
                'new_password'=>$request->password,
                'seller'=>$seller
            );   
    
            $mail_body = view('email-templates.seller-registration',$data)->render();

            $mailConfig = array(
                'mail_from_email' => env('EMAIL_FROM_ADDRESS'),
                'mail_from_name' => env('EMAIL_FROM_NAME'),
                'mail_recipient_email' =>$seller->email,
                'mail_recipient_name' => $seller->name,
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
        return redirect()->route('seller.login');
    }
}

