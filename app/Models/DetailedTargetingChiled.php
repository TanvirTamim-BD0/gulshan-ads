<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailedTargetingChiled extends Model
{
    use HasFactory;

    protected $fillable = [
        'detailed_targeting_id',
        'name',
    ];

    public function detailedTargetingData()
    {
        return $this->belongsTo(DetailedTargeting::class,'detailed_targeting_id');
    }

}
