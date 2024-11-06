<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_category_id',
        'ac_number',
    ];

    public function paymentMethodCategoryData()
    {
        return $this->belongsTo(PaymentMethodCategory::class,'payment_category_id');
    }


}
