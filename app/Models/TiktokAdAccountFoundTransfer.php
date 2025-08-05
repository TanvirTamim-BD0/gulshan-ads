<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiktokAdAccountFoundTransfer extends Model
{
    use HasFactory;

        protected $fillable = [
        'user_id',
        'from_ad_account_id',
        'transfer_ad_account_id',
        'transfer_amount',
        'confirmed_date',
        'rejected_text',
        'status',
    ];

    public function fromAdAccountData()
    {
        return $this->belongsTo(AdAccount::class,'from_ad_account_id');
    }

    public function transferAdAccountData()
    {
        return $this->belongsTo(AdAccount::class,'transfer_ad_account_id');
    }

    public function userData()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
