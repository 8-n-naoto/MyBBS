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
        return $this->hasMany(CakePhoto::class,'cake_photos_id','id');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class,'cake_id','id');
    }

    public function tags()
    {
        return $this->hasMany(Tag::class,'cake_infos_id','id');
    }

    public function basic_ingredients()
    {
        return $this->hasMany(BasicIngredient::class,'cake_infos_id','id');
    }

}
