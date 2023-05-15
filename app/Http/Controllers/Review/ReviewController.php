<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\Controller;
use App\Models\{Category, Project, Review};
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    protected string $page = 'Review';

    protected function getProjectReview()
    {
        if (Auth::user()->role_id == 1) {
            $project = Project::where('created_by', Auth::user()->id)
                ->orderBy('created_at', 'desc')->first();
        } elseif (Auth::user()->role_id == 2) {
            $project = Project::whereHas('getLeader', function ($q) {
                $q->where('id', Auth::user()->created_by);
            })->orderBy('created_at', "desc")->first();
        }
        $last_review = Review::where('created_by', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->first();

        $code_suffix = $last_review ? ((int) substr($last_review->code, 2)) + 1 : 1;
        if ($code_suffix > 999) {
            $code_suffix = 1;
        }

        $data = [
            'project' => $project,
            'code' => $code_suffix,
        ];

        return $data;
    }

    protected function getCategoryReview()
    {
        return Category::all();
    }
}
