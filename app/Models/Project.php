<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $table = 'project';
    public $incrementing = false;
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

    public function hasProject()
    {
        return $this->hasMany(Review::class, 'project_id');
    }

    public static function deleteOldRecycle()
    {
        $projects = Project::where('deleted_at', '<', Carbon::now()->subWeek())
                    ->get();
        
        foreach ($projects as $project) {
            $project->delete();
        }
    }
}
