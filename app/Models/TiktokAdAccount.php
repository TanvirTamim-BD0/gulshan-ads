<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiktokAdAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ad_account_number',
        'ad_name',
        'balance',
        'daily_limit',
        'payment_threshold',
        'daily_spending_user',
        'monthly_billing_date',
        'card_4_digit',
        'facebook_page_url_1',
        'facebook_page_url_2',
        'facebook_page_url_3',
        'facebook_page_url_4',
        'facebook_page_url_5',
        'website_url',
        'business_manager_id',
        'confirmed_date',
        'rejected_text',
        'status',
    ];

    public function userData()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
