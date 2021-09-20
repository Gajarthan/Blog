<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static orderBy(string $string, string $string1)
 */
class Posts extends Model
{
    use HasFactory,Sluggable;

    protected $fillable = [
        'id',
        'title',
        'slug',
        'description',
        'imagePath',
        'userId',
        'categoryId',
    ];

    public function sluggable() : array
    {
        return [
            'slug'=>[
                'source'=>'title'
            ]
        ];

    }
    public function categories(): BelongsTo
    {
        return $this->belongsTo(Categories::class,'categoryId');
    }
}
