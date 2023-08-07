<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\News;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['created_by', 'news_id', 'comment'];

    public function news()
    {
        return $this->belongsTo(News::class, 'news_id');
    }
}
