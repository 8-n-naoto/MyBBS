<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CakePhoto extends Model
{
    use HasFactory;

    protected $fillable =[
        'cake_photos_id',
        'photoname',
        'subphotos',
    ];

    public function cake_infos()
    {
        return $this->belongsTo(CakeInfo::class,'cake_photos_id','id');
    }
}
