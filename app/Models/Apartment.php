<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    protected $appends = ['project_name']; 

    public function media() 
    {
        return $this->belongsTo(ApartmentMedia::class, 'id_media');
    }

    public function getProjectNameAttribute()
    {
        return $this->project?->name;
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'id_project');
    }

}
