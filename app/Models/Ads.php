<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_logo',
        'site_name',
        'headline_text',
        'ads_1',
        'ads_2',
        'ads_3',
        'ads_4',
        'ads_5',
        'ads_6',
        'ads_text_1',
        'ads_text_2',
        'ads_text_3',
        'ads_text_4',
        'ads_text_5',
        'ads_text_6',
        'ads_link_1',
        'ads_link_2',
        'ads_link_3',
        'ads_link_4',
        'ads_link_5',
        'ads_link_6',
    ];

}