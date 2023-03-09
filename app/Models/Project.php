<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Project extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
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
        return $this->hasMany(ProjectSLR::class, 'project_id');
    }

    public static function getProjects($select) {
        $projects = DB::table('projects');

        // if($search_keyword && !empty($search_keyword)) {
        //     $users->where(function($q) use ($search_keyword) {
        //         $q->where('users.name', 'like', "%{$search_keyword}%")
        //         ->orWhere('users.email', 'like', "%{$search_keyword}%");
        //     });
        // }

        if($select && !empty($select)) {
            $projects->where(function($q) use ($select) {
                $q->where('projects.title', 'like', "%{$select}%")
                ->orWhere('projects.uuid_project', 'like', "%{$select}%");
            });
        }

        return $projects->orderBy("id", "Desc")->paginate(6);
    }
}
