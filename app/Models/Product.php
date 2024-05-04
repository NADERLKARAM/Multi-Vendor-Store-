<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'store_id',
        'category_id',
        'name',
        'slug',
        'description',
        'image',
        'price',
        'compare_price',
        'options',
        'rating',
        'featured',
        'status',
        'name', 'slug',
    ];


    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function attachTags($tagNames)
    {
        foreach ($tagNames as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $this->tags()->attach($tag->id);
        }
    }

    public function save(array $options = [])
    {
        // Generate the slug based on the product name if it's not already set
        if (!isset($this->attributes['slug']) || $this->attributes['slug'] === null) {
            $this->attributes['slug'] = Str::slug($this->attributes['name']);
        }

        // Call the parent save method
        return parent::save($options);
    }
}