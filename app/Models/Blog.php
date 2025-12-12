<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;

    protected $table = 'blog';
    protected $fillable = ['title','content','image','category_id'];

    public function category()
    {
        return $this->belongsToMany(Category::class);
    }
}
