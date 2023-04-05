<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institute extends Model
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
}
