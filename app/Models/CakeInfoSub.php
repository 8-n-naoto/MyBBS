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

    public function cake_infos()
    {
        return $this->belongsTo(CakeInfo::class,'cake_infos_id','id');
    }
}
