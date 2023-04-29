<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectSLR extends Model
{
    use HasFactory;
    protected $table = 'project_slr';
    protected $guarded = [];

    protected $hidden = [
        'id', 'uuid_project_slr', 'project_id', 'category_id',
        'created_by', 'created_at', 'updated_by', 'updated_at',
        'deleted_by', 'deleted_at',
        'title', 'references'
    ];

    public function getProject()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    public function getCategory()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function getUser()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function getDeletedData()
    {
        return $this->belongsTo(User::class, 'deleted_by', 'id');
    }

    public function getMember()
    {
        return $this->belongsTo(Member::class, 'created_by', 'id');
    }

    public static function deleteOldRecycle()
    {
        $projects = ProjectSLR::whereNotNull('deleted_by')
            ->where('deleted_at', '<', Carbon::now()->subWeek())
            ->get();

        foreach ($projects as $project) {
            $project->delete();
        }
    }
}
