<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdAccountSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user',
        'account_name',
        'current_balance',
        'daily_limit',
        'payment_threshold',
        'daily_spending_user',
        'monthly_billing_date',
        'card_4_digit',
        'business_manager_id',
        'social',
        'status',
        'action',
    ];

}
