<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsLog extends Model
{
    use HasFactory;
    protected $table = 'news_logs';
    protected $fillable = ['news_id', 'action', 'created_at'];
}
