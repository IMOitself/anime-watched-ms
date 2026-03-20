<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Anime extends Model
{
    use HasFactory;

    protected $fillable = [
        'mal_id',
        'image_url',
        'title',
        'score',
        'episodes'
    ];
}
