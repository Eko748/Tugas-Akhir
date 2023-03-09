<?php
  
namespace App\Http\Controllers\Management;
  
use App\Http\Controllers\Controller;
use App\Models\Institute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class InstituteController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            "institute_name" => "required"
        ]);

        Institute::create([
            "uuid_institute" => Str::uuid(),
            "user_id" => Auth::user()->id,
            "institute_name" => $request->institute_name,
            "institute_slug" => Str::of($request->institute_name)->slug(""),
            "created_by" => Auth::user()->id,
        ]);

        return response()->json(["success" => "true"]);
    }
}