<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

/**
 * @method static orderBy(string $string, string $string1)
 */
class Posts extends Model
{
    use HasFactory,Sluggable;

    protected $fillable = ['title',
        'slug',
        'decription',
        'image_path',
        'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sluggable() : array
    {
        return [
            'slug'=>[
                'source'=>'title'
            ]
        ];

    }
}
