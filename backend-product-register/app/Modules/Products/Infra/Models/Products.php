<?php

namespace App\Modules\Products\Infra\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name',
        'price',
        'image',
        'situation',
        'category_id'
    ];

    public $timestamps = true;

    public function category()
    {
        return $this->belongsTo('App\Modules\Category\Infra\Models\Category', 'category_id', 'id');
    }
}
