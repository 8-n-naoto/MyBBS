<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CakeInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'cakename',
        'mainphoto',
        'topic',
        'explain',
        'cakecode',
    ];

    public function cake_info_subs()
    {
        return $this->hasMany(CakeInfoSub::class,'cake_infos_id','id');
    }

    public function cake_photos()
    {
        return $this->hasMany(CakePhoto::class,'cake_infos_id','id');
    }
}
