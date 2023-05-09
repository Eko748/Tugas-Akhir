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

    public function showDashboard()
    {
        $review = $this->requestChartReview();
        $member = $this->requestChartByCode();
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
        $get = $this->getReviewData();

        $categoryCounts = $get['reviews']->countBy('category_id');
        $categoryLabels = ['IEEE', 'ACM', 'Springer'];
        $categoryData = [
            $categoryCounts->get(1, 0),
            $categoryCounts->get(2, 0),
            $categoryCounts->get(3, 0)
        ];
        $totalReviews = $get['reviews']->count();
        $data = [
            'categoryLabels' => $categoryLabels,
            'categoryData' => $categoryData,
            'totalReviews' => $totalReviews
        ];
        return $data;
    }

    private function requestChartByCode()
    {
        if (Auth::user()->role_id == 1) {
            $leader = Auth::user()->hasLeader->first();
            $member = Member::whereHas('getLeader', function ($q) use ($leader) {
                $q->where('created_by', $leader->id);
            })->count();
            $user = $member + 1;
        } elseif (Auth::user()->role_id == 2) {
            $members = Auth::user()->created_by;
            $member = User::where('created_by', $members)->count();
            $user = $member + 1;
        }

        $get = $this->getReviewData();
        $userCount = $get['reviews']->countBy('created_by');
        $userLabels = $userCount->keys()->map(function ($key) {
            return User::orderBy('code', 'asc')->find($key)->code;
        })->sort();

        $userLabels = $userLabels->sort();
        $indexA = $userLabels->search('A');
        if ($indexA !== false && $indexA !== 0) {
            $userLabels->prepend($userLabels->pull($indexA));
        }
        $userData = $userCount->sortBy(function ($value, $key) use ($userLabels) {
            return $userLabels->search(User::find($key)->code);
        })->values();


        $data = [
            'userLabels' => $userLabels,
            'userData' => $userData,
            'totalUsers' => $user
        ];
        return $data;
    }

    private function getReviewData()
    {
        if (Auth::user()->role_id == 1) {
            $reviews = Review::whereHas('getProject.getLeader', function ($q) {
                $q->where('user_id', Auth::user()->id);
            })->get();
        } elseif (Auth::user()->role_id == 2) {
            $reviews = Review::whereHas('getProject.getLeader', function ($q) {
                $q->where('leader_id', Auth::user()->created_by);
            })->get();
        }

        $data = [
            'reviews' => $reviews
        ];
        return $data;
    }
}
