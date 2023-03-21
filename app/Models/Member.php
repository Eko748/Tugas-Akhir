<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getRole()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function getLeader()
    {
        return $this->belongsTo(Leader::class, 'created_by', 'id');
    }

    public function hasProjectSLR()
    {
        return $this->hasMany(ProjectSLR::class, 'project_id');
    }
}
