<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leader extends Model
{
    use HasFactory;
    protected $table = 'leader';
    public $incrementing = false;
    protected $guarded = [];

    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getRole()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function hasProject()
    {
        return $this->hasMany(Project::class, 'leader_id');
    }

    public function hasMember()
    {
        return $this->hasMany(Member::class, 'created_by');
    }

    public function hasInstitute()
    {
        return $this->hasMany(Institute::class, 'leader_id');
    }
}
