<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CakeInfoSub extends Model
{
    use HasFactory;

    protected $fillable=[
        'cake_infos_id',
        'capacity',
        'price',
        'cakecode',
    ];

    public function cake_info()
    {
        return $this->belongsTo(CakeInfo::class,'cake_infos_id','id');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class,'cake_info_subs_id','id');
    }
}
