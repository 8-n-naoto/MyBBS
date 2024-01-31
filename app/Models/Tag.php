<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'tag',
        'cake_infos_id',
    ];

    public function cake_Info()
    {
        return $this->belongsTo(CakeInfo::class, 'cake_infos_id', 'id');
    }
}
