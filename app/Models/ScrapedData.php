<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScrapedData extends Model
{
    use HasFactory;
    public $table = 'scraped_data';
    public $incrementing = false;
    protected $guarded = [];
    protected $hidden = [
        'id', 'uuid_scrape', 'project_id', 'category_id',
        'created_by', 'created_at', 'updated_by', 'updated_at',
        'deleted_by', 'deleted_at',
    ];

    public function getProject()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function getCategory()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getUser()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getDeletedData()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    public static function deleteOldRecycle()
    {
        $projects = ScrapedData::whereNotNull('deleted_by')
            ->where('deleted_at', '<', Carbon::now()->subWeek())
            ->get();

        foreach ($projects as $project) {
            $project->delete();
        }
    }
}
