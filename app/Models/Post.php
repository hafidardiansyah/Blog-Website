<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'body'];
    // protected $guarded = []; for admin because not recomended for user

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
