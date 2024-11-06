<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdAccountBMLinkRequest extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'bm_name',
        'reply',
        'status',
    ];

    public function userData()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
