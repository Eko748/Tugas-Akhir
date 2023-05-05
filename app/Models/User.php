<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $table = 'user';
    public $incrementing = false;
    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
        'uuid_user', 'role_id', 'email_verified_at', 
        'created_by', 'created_at', 'updated_by', 'updated_at', 
        'deleted_by', 'deleted_at',
        'status', 'last_seen_ip'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hasLeader()
    {
        return $this->hasMany(Leader::class, 'user_id');
    }
    
    public function socialAccounts()
    {
        return $this->hasMany(SocialAccount::class);
    }

    public function getRole()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function getDeletedData()
    {
        return $this->belongsTo(Leader::class, 'deleted_by', 'id');
    }

    public function hasInstitute()
    {
        return $this->hasOne(Institute::class, 'created_by');
    }

    public function hasAdmin()
    {
        return $this->hasOne(Admin::class, 'user_id');
    }

    public function hasMember()
    {
        return $this->hasMany(Member::class, 'user_id');
    }

    public function hasProject()
    {
        return $this->hasMany(Project::class, 'created_by');
    }

    public function hasProjectSLR()
    {
        return $this->hasMany(ProjectSLR::class, 'created_by');
    }

    public function hasDataProjectSLR()
    {
        return $this->hasMany(ProjectSLR::class, 'deleted_by');
    }

}
