<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleAlbum extends Model
{
    use HasFactory;

    protected $fillable = ['article_id', 'path'];
}
