<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyService extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_id',
        'invoice_no',
        'confirmed_date',
        'confirmed_text',
        'rejected_text',
        'status',
    ];

    public function userData()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function serviceData()
    {
        return $this->belongsTo(Services::class,'service_id');
    }

}
