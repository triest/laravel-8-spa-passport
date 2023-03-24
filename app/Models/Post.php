<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Post extends BaseModel
{
    use HasFactory;


    protected $fillable = ['title', 'description'];


    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
