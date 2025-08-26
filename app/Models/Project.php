<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;
    
    public function media()
    {
        return $this->hasMany(ProjectMedia::class);
    }
    
    public function titleImage()
    {
        return $this->hasOne(ProjectMedia::class)->where('type', 'title');
    }
    
    public function descriptionImage()
    {
        return $this->hasOne(ProjectMedia::class)->where('type', 'description');
    }
    
    public function galleryImages()
    {
        return $this->hasMany(ProjectMedia::class)->where('type', 'gallery');
    }
    

    public function location()
    {
        return $this->belongsTo(Location::class, 'id_location');
    }
    
    public function transports()
    {
        return $this->hasOne(Transport::class);
    }


    public function infrastructures()
    {
        return $this->hasOne(Infrastructure::class);
    }

    public function places()
    {
        return $this->hasMany(Place::class);
    }

    public function architectures()
    {
        return $this->hasOne(Architecture::class);
    }

    public function apartments()
    {
        return $this->hasMany(Apartment::class, 'id_project');
    }

}
