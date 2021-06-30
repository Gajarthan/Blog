<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * @method static orderBy(string $string, string $string1)
 */
class Categories extends Model
{
    use HasFactory,Sluggable;

    protected $fillable = [
        'id',
        'name',
        'slug',
        'description',
        'imagePath',
        'userId'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function sluggable() : array
    {
        return [
            'slug'=>[
                'source'=>'name'
            ]
        ];
    }
}
