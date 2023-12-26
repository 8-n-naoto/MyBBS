<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CakePhoto extends Model
{
    use HasFactory;

    protected $fillable =[
        'cake_infos_id',
        'photoname',
        'subphotos',
    ];

    public function cake_infos()
    {
        return $this->belongsTo(Cake_info::class,'cake_infos_id','id');
    }
}
