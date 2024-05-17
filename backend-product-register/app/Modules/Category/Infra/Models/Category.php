<?php

namespace App\Modules\Category\Infra\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{


    protected $table = 'category';

    protected $fillable = [
        'name',
        'situation',
    ];

    public $timestamps = true;
}
