<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethodCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_type',
        'payment_method',
        'icon',
    ];

    public function paymentMethodmasData()
    {
        return $this->hasMany(PaymentMethod::class,'payment_category_id');
    }

}
