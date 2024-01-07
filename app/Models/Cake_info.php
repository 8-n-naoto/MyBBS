<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cake_info extends Model
{
    public $table = 'cake_infos';

    protected $fillable = [
        'cakename',
        'mainphoto',
        'topic',
        'explain',
        'cakecode',
        'boolean'
    ];

    public function cake_info_sub()
    {
        return $this->hasMany(Cake_info_sub::class);
    }

    // public function cake_photo()
    // {
    //     return $this->hasMany(Cake_photo::class);
    // }
}
