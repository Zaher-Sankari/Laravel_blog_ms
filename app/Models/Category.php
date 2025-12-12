<?php

namespace App\Models;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $fillable = ['name'];

    public function posts()
    {
        return $this->belongsToMany(Blog::class);
    }
}
