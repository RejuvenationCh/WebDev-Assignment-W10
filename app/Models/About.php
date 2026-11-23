<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class About extends Model
{
    use HasFactory;

    protected $table = 'table_abouts';

    protected $fillable = ['name', 'personal_description', 'image_path'];

    public function items(): HasMany
    {
        return $this->hasMany(AboutItem::class)->orderBy('sort_order')->orderBy('id');
    }
}
