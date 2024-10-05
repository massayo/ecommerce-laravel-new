<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Seller;
use App\Models\PaymentMethod;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\On;

class SellerProfileTabs extends Component
{
    public $tab = null;
    public $tabname = 'personal_details';
    protected $queryString = ['tab'];
    public $name, $email, $username, $seller_id,$address,$phone,$payment_method_id = '0',$payment_email, $payment_methods, $seller_gender
    ,$card_number, $cvc, $exp_month, $exp_year, $genders, $months, $years;
    public $current_password, $new_password, $new_password_confirmation;

    public function selectTab($tab){
        $this->tab = $tab;
    }
    
    public function mount(){
        $this->tab = request()->tab ? request()->tab : $this->tabname;

        if(Auth::guard('seller')->check()){
           $seller = Seller::findOrFail(auth()->id());
           $this->seller_id = $seller->id;
           $this->name = $seller->name; 
           $this->email = $seller->email;
           $this->username = $seller->username;
           $this->address = $seller->address;
           $this->phone = $seller->phone; 
           $this->payment_method_id = $seller->payment_method_id;
           $this->payment_email = $seller->payment_email;
           $this->seller_gender = $seller->gender;
           $this->card_number = $seller->card_number;
           $this->cvc = $seller->cvc;
           $this->exp_month = $seller->exp_month;
           $this->exp_year = $seller->exp_year;
        }

        $this->payment_methods = PaymentMethod::orderby("payment_name","asc")
                                                ->select('id','payment_name')
                                                ->get();
        $this->genders = [
            'male'=>'Male',
            'female'=>'Female'
        ];

        $this->months = [
              1 => 'January',
              2 => 'February',
              3 => 'March',
              4 => 'April',
              5 => 'May',
              6 => 'June',
              7 => 'July',
              8 => 'August',
              9 => 'September',
              10 => 'October',
              11 => 'November',
              12 => 'December',
        ];

        $this->years = [
            2035 => '2035',
            2034 => '2034',
            2033 => '2033',
            2032 => '2032',
            2031 => '2031',
            2030 => '2030',
            2029 => '2029',
            2028 => '2028',
            2027 => '2027',
            2026 => '2026',
            2025 => '2025',
            2024 => '2024',
        ];

        /*$this->dispatch('payment-methods', details:[
            'payments' => $this->payment_methods
        ]);*/
    }

    public function updateSellerPersonalDetails(){
        $this->validate(
            [
               'name' => 'required|min:5|max:45',
               'email' => 'required|email|unique:sellers,email,'.$this->seller_id,
               'username' => 'required|min:3|unique:sellers,username,'.$this->seller_id,
               'payment_email' => 'required|email',
               'card_number'=> 'required|integer|max_digits:20',
               'cvc'=> 'required|integer|max_digits:5'
            ]);

            Seller::find($this->seller_id)
                 ->update([
                    'name' => $this->name,
                    'email' => $this->email,
                    'username' => $this->username,
                    'address' => $this->address,
                    'phone' => $this->phone, 
                    'payment_method_id' => $this->payment_method_id,
                    'payment_email' => $this->payment_email,
                    'gender' =>  $this->seller_gender,
                    'card_number' =>  $this->card_number,
                    'cvc' =>  $this->cvc,
                    'exp_month' =>  $this->exp_month,
                    'exp_year' =>  $this->exp_year
                 ]);
            $this->dispatch('success-seller-details', details:[
                'sellerName' => $this->name,
                'sellerEmail' => $this->email
            ]);
            //$this->showToastr('success','Your personal details have been successfully updated.');
    }
    
    public function updatePassword()
    {
        $this->validate([
            'current_password' =>[
                'required',function($attribute, $value, $fail){
                     if(!Hash::check($value, Seller::find(auth('seller')->id())->password)){
                        return $fail(__('The current password is incorrect!'));
                     }
                }
            ],
            'new_password' => 'required|min:5|max:45|confirmed',
        ]);
        $query = Seller::FindOrFail(auth('seller')->id())->update([
            'password'=>Hash::make($this->new_password)
        ]);

        if($query){
           //Send mail notification
           $_seller = Seller::FindOrFail($this->seller_id);
            $data = array(
                'new_password'=>$this->new_password,
                'seller'=>$_seller
            );   
    
            $mail_body = view('email-templates.seller-reset-email-template',$data)->render();
    
            $mailConfig = array(
                'mail_from_email' => env('EMAIL_FROM_ADDRESS'),
                'mail_from_name' => env('EMAIL_FROM_NAME'),
                'mail_recipient_email' =>$_seller->email,
                'mail_recipient_name' => $_seller->name,
                'mail_subject' => 'Password changed',
                'mail_body' => $mail_body
            );

            sendEmail($mailConfig);

            $this->current_password = $this->new_password = $this->new_password_confirmation = null;
            $this->dispatch('success-password');
            //$this->showToastr('success','Password successfully updated!',200);
        }else{
            $this->dispatch('error-password');
        }
    }

    public function showToastr($type, $message, $status=401)
    {
        return $this->dispatchBrowserEvent('showToastr',[
            'type' => $type,
            'message' => $message,
            'status'  => $status
        ]);
    }
    //#[On('success-seller-details')]
    public function render()
    {
        return view('livewire.seller-profile-tabs');
    }
}
