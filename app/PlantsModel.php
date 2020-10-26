<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlantsModel extends Model
{
    protected $fillable = [
        'name', 'image',
    ];
}
