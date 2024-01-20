<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cake_info_subs_id',
        'message',
    ];

    public function cake_info_sub()
    {
        return $this->belongsTo(CakeInfoSub::class,'cake_info_subs_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
