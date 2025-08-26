<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use HasFactory;

    public $timestamps = true;
    
    public function media()
    {
        return $this->belongsTo(NewsMedia::class, 'id_media');
    }
}