<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $table = 'payment_methods';
    protected $primaryKey = 'id';
    public    $timestamps = true;
    protected $fillable = [
        'payment_name'
    ];

    public function getSellers()
    {
        return $this->hasMany(Seller::class);
    }

    public function getClients()
    {
        return $this->hasMany(Client::class);
    }
}
