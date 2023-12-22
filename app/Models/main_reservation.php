<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Main_reservation extends Model
{
    public $table = 'main_reservation';

    protected $fillable=[
        'users_id',
        'birthday',
        'time'
    ];

    public function sub_reservations()
    {
        return $this->hasMany(Sub_reservation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
