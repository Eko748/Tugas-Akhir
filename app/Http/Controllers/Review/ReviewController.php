<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\Controller;
use App\Models\{Category, Project};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    protected string $page = 'Review';

    protected function getProjectReview(Request $request)
    {
        $search = $request->q;
        $id = $request->id;

        if (Auth::user()->role_id == '1') {
            $projects = Project::whereHas('getLeader', function ($query) use ($id) {
                $query->where('user_id', $id);
            })
                ->where('subject', 'LIKE', '%' . $search . '%')
                ->orWhere('priority', 'LIKE', '%' . $search . '%')
                ->where('start_date', '<=', now())
                ->where('end_date', '>=', now())
                ->orderBy('priority', 'asc')
                ->get();
        } else {
            $projects = Project::where('subject', 'LIKE', '%' . $search . '%')
                ->orWhere('priority', 'LIKE', '%' . $search . '%')
                ->orderBy('priority', 'asc')
                ->get();
        }
        return $projects;
    }

    protected function getCategoryReview(Request $request)
    {
        $search = $request->q;
        $category = Category::where('category_code', 'LIKE', '%' . $search . '%')
            ->orWhere('category_name', 'LIKE', '%' . $search . '%')
            ->orderBy('category_code', 'asc')
            ->get();
        return $category;
    }
}
