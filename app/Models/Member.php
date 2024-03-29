<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    public $table = 'member';
    public $incrementing = false;
    public $timestamps = false;
    protected $guarded = [];

    public function getUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getLeader()
    {
        return $this->belongsTo(Leader::class, 'created_by', 'id');
    }

    public function hasReview()
    {
        return $this->hasMany(Review::class, 'project_id');
    }

    public static function deleteOldRecycle()
    {
        $projects = User::where('deleted_at', '<', Carbon::now()->subWeek())
                    ->get();
        
        foreach ($projects as $project) {
            $project->delete();
        }
    }
}
