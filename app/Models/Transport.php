<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{   
    protected $fillable = ['name', 'type', 'project_id'];
    
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
