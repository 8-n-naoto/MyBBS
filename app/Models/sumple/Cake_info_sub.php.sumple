<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cake_info_sub extends Model
{
    public $table ='cake_infos_sub';

    protected $fillable=[
        'cake_infos_id',
        'capacity',
        'price',
        'cakecode',
    ];

    public function cake_info()
    {
        return $this->belongsTo(Cake_info::class);
    }

}
