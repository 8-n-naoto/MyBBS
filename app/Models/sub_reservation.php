<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sub_reservation extends Model
{
    public $table = 'sub_reservation';

    protected $fillable=[
        'main_reservation_id',
        'cakename',
        'capacity',
        'price',
        'message',
    ];

    public function main_reservation()
    {
        return $this->belongsTo(Main_reservation::class,'main_reservation_id','id');
    }
}
