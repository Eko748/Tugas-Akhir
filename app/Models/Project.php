<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    public $table = 'project';
    public $incrementing = false;
    public $timestamps = false;
    protected $guarded = [];
    protected $hidden = [
        'uuid_project', 'leader_id',
        'created_by', 'created_at'
    ];

    public function getUser()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function getLeader()
    {
        return $this->belongsTo(Leader::class, 'leader_id', 'id');
    }

    public function hasScrapedData()
    {
        return $this->hasMany(ScrapedData::class, 'project_id');
    }

}
