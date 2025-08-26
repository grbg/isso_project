<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NewsMedia extends Model
{
    use HasFactory;

    protected $fillable = ['media_path'];

    public function news()
    {
        return $this->hasOne(News::class, 'id_media');
    }
}
