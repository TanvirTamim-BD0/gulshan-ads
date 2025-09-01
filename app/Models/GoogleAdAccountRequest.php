<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoogleAdAccountRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'account_name',
        'time_zone_name',
        'business_type',
        'facebook_page_url_1',
        'facebook_page_url_2',
        'facebook_page_url_3',
        'facebook_page_url_4',
        'facebook_page_url_5',
        'website_url',
        'website_url_2',
        'add_account_type',
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