<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutItem extends Model
{
    use HasFactory;

    protected $table = 'table_abouts_items';

    protected $fillable = ['about_id', 'title', 'description', 'sort_order'];
}
