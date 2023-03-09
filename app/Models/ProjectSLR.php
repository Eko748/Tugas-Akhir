<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectSLR extends Model
{
    use HasFactory;
    protected $table = 'project_slr';
    protected $guarded = [];

    public function getProject()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    public function getCategory()
    {
        return $this->belongsTo(Category::class, 'project_id', 'id');
    }

    public function getUser()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function getMember()
    {
        return $this->belongsTo(Member::class, 'created_by', 'id');
    }

}
