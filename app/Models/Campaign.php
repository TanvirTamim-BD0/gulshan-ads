<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_link',
        'post_image',
        'campaign_type',
        'location_id',
        'detailed_targeting_type',
        'detailed_targeting_name',
        'detailed_targeting_chiled',
        'age_start',
        'age_end',
        'gender',
        'budget',
        'days',
        'facebook',
        'instagram',
        'messenger',
        'whatsapp',
        'editor_access',
        'confirmed_date',
        'confirmed_text',
        'rejected_text',
        'running_status',
        'status',
    ];

    public function userData()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function audienceData()
    {
        return $this->belongsTo(Audience::class,'location_id');
    }


    public static function getChiledData($id)
    {   

        $data = Campaign::where('id', $id)->first();
        $detailedIds = json_decode($data->detailed_targeting_chiled);

        $getDetailedData = [];
        foreach($detailedIds as $key => $item){
            if($item != null){
                $getDetailedData[] = DetailedTargetingChiled::where('id', $item)->first();
            }
        }

        return $getDetailedData;
    }

    public static function getlocationData($id)
    {   

        $data = Campaign::where('id', $id)->first();
        $locationIds = json_decode($data->location_id);

        $getlocationData = [];
        foreach($locationIds as $key => $item){
            if($item != null){
                $getlocationData[] = Audience::where('id', $item)->first();
            }
        }

        return $getlocationData;
    }

    

}
