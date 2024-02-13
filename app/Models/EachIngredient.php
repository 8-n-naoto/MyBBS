<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EachIngredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'basic_ingredients_id',
        'ingredient_name',
        'ingredient_amount',
        'lot_amount',
        'lot_unit',
        'expiration'
    ];

    public function basic_ingredient()
    {
        return $this->belongsTo(BasicIngredient::class,'basic_ingredients_id','id');
    }
}
