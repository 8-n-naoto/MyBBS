<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cake_photo extends Model
{
    public $table = 'cake_photo';

    protected $fillable =[
        'cake_infos_id',
        'photoname',
        'subphotos',
    ];

    public function cake_info()
    {
        return $this->belongsTo(Cake_info::class);
    }

}
