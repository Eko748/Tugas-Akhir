<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class Project extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function getUser()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function getLeader()
    {
        return $this->belongsTo(Leader::class, 'leader_id', 'id');
    }

    public function hasProject()
    {
        return $this->hasMany(ProjectSLR::class, 'project_id');
    }
}
