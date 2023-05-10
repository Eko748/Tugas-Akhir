<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table = 'role';
    protected $guarded = [];
    public $timestamps = false;

    public function hasUser()
    {
        return $this->hasMany(User::class);
    }

    public function hasLeader()
    {
        return $this->hasMany(Leader::class);
    }

    public function hasMember()
    {
        return $this->hasMany(Member::class);
    }
}
