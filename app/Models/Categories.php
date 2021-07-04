<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


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

    public function sluggable() : array
    {
        return [
            'slug'=>[
                'source'=>'name'
            ]
        ];
    }
    public function post(): HasMany
    {
        return $this->hasMany(Posts::class);
    }
}
