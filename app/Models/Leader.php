<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leader extends Model
{
    use HasFactory;
    public $table = 'leader';
    public $incrementing = false;
    public $timestamps = false;
    protected $guarded = [];
                          
    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
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
