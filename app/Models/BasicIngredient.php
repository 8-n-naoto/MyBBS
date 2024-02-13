<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasicIngredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'cake_infos_id',
        'basic_amount',
        'ingredient_unit',
    ];

    public function cake_info()
    {
        return $this->belongsTo(CakeInfo::class,'cake_infos_id','id');
    }
}
