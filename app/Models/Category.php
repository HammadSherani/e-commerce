<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model

{
    protected $table =  "category";
    protected $primaryKey =  "id";
    protected $fillable =  ["name", "slug", "status"];
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->slug = static::generateSlug($post->name);
        });

        static::updating(function ($post) {
            if ($post->isDirty('name')) {
                $post->slug = static::generateSlug($post->name);
            }
        });
    }


    private static function generateSlug($name)
    {
        $slug = Str::slug($name);
        

        $originalSlug = $slug;
        $count = 1;

        // Ensure the slug is unique
        while (static::whereSlug($slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        return $slug;
    }
}
