<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\Project;
use App\Models\Review;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    private string $label = 'Dashboard';
    private string $page;
    private array $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function index()
    {
        $review = $this->requestChartReview();
        $member = $this->requestChartCommit();
        $this->page = Auth::user()->getRole->role_name;
        $this->data = [
            'parent' => $this->label,
            'child' => $this->page,
            'categoryLabels' => $review['categoryLabels'],
            'categoryData' => $review['categoryData'],
            'totalReviews' => $review['totalReviews'],
            'userLabels' => $member['userLabels'],
            'userData' => $member['userData'],
            'totalUser' => $member['totalUsers'],
        ];
        return view('pages.dashboard.index', $this->data);
    }

    private function requestChartReview()
    {
        $auth = Auth::user()->id;
        $reviews = Review::whereHas('getProject', function ($q) use ($auth) {
            $q->where('created_by', $auth);
        })->get();
        $categoryCounts = $reviews->countBy('category_id');
        $categoryLabels = ['IEEE', 'ACM', 'Springer'];
        $categoryData = [
            $categoryCounts->get(1, 0),
            $categoryCounts->get(2, 0),
            $categoryCounts->get(3, 0)
        ];
        $totalReviews = $reviews->count();
        $data = [
            'categoryLabels' => $categoryLabels,
            'categoryData' => $categoryData,
            'totalReviews' => $totalReviews
        ];
        return $data;
    }

    private function requestChartCommit()
    {
        $leader = Auth::user()->hasLeader->first();
        $members = Auth::user()->created_by;
        if (Auth::user()->role_id == 1) {
            $member = Member::whereHas('getLeader', function ($q) use ($leader) {
                $q->where('created_by', $leader->id);
            })->count();
            $user = $member + 1;
        } elseif (Auth::user()->role_id ==2) {
            $member = User::where('created_by', $members)->count();
            $user = $member + 1;
        }

        $auth = Auth::user()->id;
        $reviews = Review::whereHas('getProject', function ($q) use ($auth) {
            $q->where('created_by', $auth);
        })->get();
        $userCount = $reviews->countBy('created_by');
        $userLabels = $userCount->keys()->map(function ($key) {
            return User::find($key)->code;
        });
        $userData = $userCount->values();
        
        $data = [
            'userLabels' => $userLabels, 
            'userData' => $userData,
            'totalUsers' => $user
        ];
        return $data;
    }
}
