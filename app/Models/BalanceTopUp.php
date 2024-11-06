<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BalanceTopUp extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment_id',
        'payment_method_id',
        'manual_payment',
        'bdt',
        'usd',
        'confirmation_screenshot',
        'confirmed_date',
        'rejected_text',
        'status',
    ];

    public function paymentMethodData()
    {
        return $this->belongsTo(PaymentMethod::class,'payment_method_id');
    }

    public function userData()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}