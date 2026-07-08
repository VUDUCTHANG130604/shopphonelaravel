<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $primaryKey = 'product_id';

    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo(
            Category::class,
            'category_id',
            'category_id'
        );
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'product_id', 'product_id');
    }
    protected $fillable = [
        'category_id',
        'name',
        'image',
        'quantity',
        'sell_quantity',
        'price',
        'sale_price',
        'create_date',
        'views',
        'details',
        'short_description',
        'status'
    ];
}
