<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $primaryKey = 'post_id';

    public $timestamps = true;

    protected $fillable = [
        'category_id',
        'title',
        'image',
        'author',
        'content',
        'views',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(PostCategory::class, 'category_id', 'id');
    }
}
