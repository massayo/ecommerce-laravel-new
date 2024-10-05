<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Client extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guard = 'client';
    protected $table = 'clients';
    protected $primaryKey = 'id';
    public    $timestamps = true;
    protected $fillable = [
        'name','username','email','password','picture','address','phone','email_verified_at','status','payment_method_id','payment_email'
        ,'gender','card_number','cvc','exp_month','exp_year'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getPictureAttribute($value)
    {
        if($value){
            return asset('/images/users/clients/'.$value);
        }
        else{
            return asset('/images/users/default-avatar.png');
        }
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
