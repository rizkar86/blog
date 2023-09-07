<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected  $fillable = ['title','image','short_content','content'];

    public  function  categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public  function  users()
    {
        return $this->belongsToMany(User::class);
    }


}
