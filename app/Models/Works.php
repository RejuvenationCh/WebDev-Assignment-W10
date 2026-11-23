<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Works extends Model
{
    /** @use HasFactory<\Database\Factories\WorksFactory> */
    use HasFactory;

     protected $fillable = [
        'title','subtitle', 'content', 'image_path', 'project_url', 'is_published', 'is_featured',
    ];
}
