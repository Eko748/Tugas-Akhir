<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'category';
    protected $guarded = [];

    public function hasProjectSLR()
    {
        return $this->hasMany(ProjectSLR::class, 'project_id');
    }
}
