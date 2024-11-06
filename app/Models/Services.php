<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_category_id',
        'name',
        'detals',
        'price',
        'image',
    ];


    public function serviceCategoryData()
    {
        return $this->belongsTo(ServiceCategory::class,'service_category_id');
    }
}