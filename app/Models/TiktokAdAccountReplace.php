<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiktokAdAccountReplace extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ad_account_id',
        'screenshot_of_rejected_appeal',
        'business_manager_id',
        'confirmed_date',
        'rejected_text',
        'status',
    ];  

    public function adAccountData()
    {
        return $this->belongsTo(TiktokAdAccount::class,'ad_account_id');
    }

    public function userData()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
