<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Yajra\DataTables\Facades\DataTables;

class MemberController extends Controller
{
    public function index()
    {
        $user = User::with('hasInstitute')->whereHas('hasInstitute', function ($q) {
            $q->where('user_id', Auth::user()->id);
        })->first();

        $coba = User::all();

        $data = [
            "parent" => "Management",
            "child" => "Member",
            "institute" =>  $user,
            "coba" => $coba,
        ];
        return view('pages.management.member.index', $data);
    }

    public function getTable(Request $request)
    {
        if ($request->ajax()) {
            $data = Member::with('getUser')->where('created_by', Auth::user()->id)->orderBy("created_at", "DESC")->get();
            // $data = User::where('created_by', Auth::user()->id)->orderBy("created_at", "DESC")->get();
            return DataTables::of($data)
                ->addIndexColumn()->addColumn('action', function ($data) {
                    $btn = '<div style="text-align: center; vertical-align: middle;">
                                <button title="Detail" class="btn btn-primary btn-sm btn-outline-dark hovering shadow-sm" onclick="readMember(' . $data->id . ')">
                                    <i class="fa fa-address-book"></i>
                                </button>
                                <button title="Edit" class="btn btn-success btn-sm btn-outline-dark hovering shadow-sm" onclick="editMember(' . $data->getUser->id . ')" type="button" data-bs-toggle="modal" data-bs-target="#updateMember">
                                    <i class="fa fa-pencil"></i>
                                </button>
                                <button title="Delete" class="btn btn-danger btn-s btn-outline-dark hovering shadow-sm" onclick="deleteMember(' . $data->id . ')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>';
                    return $btn;
                })->addColumn('date', function ($data) {
                    $date = $data->getUser->last_seen;
                    $parse = Carbon::parse($date)->isoFormat('LLLL');
                    $danger = '<span class="badge btn-outline-danger hovering badge-light-danger">Belum ada riwayat Login</span>';
                    $info = '<span class="badge btn-outline-primary hovering badge-light-primary">' . $parse . '</span>';

                    if ($date == null) {
                        return $danger;
                    } else {
                        return $info;
                    }
                    return $date;
                })->addColumn('ip', function ($data) {
                    $ip = $data->getUser->last_seen_ip;
                    $danger = '<span class="badge btn-outline-danger hovering badge-light-danger">Belum ada riwayat Login</span>';
                    $info = '<span class="badge btn-outline-primary hovering badge-light-primary">' . $ip . '</span>';

                    if ($ip == null) {
                        return $danger;
                    } else {
                        return $info;
                    }
                    return $ip;
                })->addColumn('info', function ($data) {
                    $online = '<span class="text-success">Online</span>';
                    $offline = '<span class="text-secondary">Offline</span>';
                    $user_id = $data->getUser->id;
                    if (Cache::has('user-is-online-' . $user_id)) {
                        return $online;
                    } else {
                        return $offline;
                    }
                    return $user_id;
                })->rawColumns(['action', 'date', 'info', 'ip'])->make(true);
        }
    }

    public function getUser(Request $req)
    {
        $users = []; 

        if ($req->has('q')) {
            $search = $req->q;
            $users = User::select("id", "name", "email")
                ->where('name', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($users);
    }

    public function create(Request $request)
    {
        $user = User::with('hasInstitute')->whereHas('hasInstitute', function ($q) {
            $q->where('user_id', Auth::user()->id);
        })->first();

        if ($user == null) {
            return redirect()->route('management.member.index');
        } else {
            $institute = $user->hasInstitute->institute_slug;
        }

        $array = array($institute, $request->email);
        $string = implode('.', $array);

        $auth = Auth::user()->id;
        $token = Str::random(64);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Rules\Password::defaults()],
            'status' => ['required', 'integer'],
        ]);

        $userCreate = User::create(
            [
                'role_id' => 2,
                'name' => $request->name,
                'email' => $string,
                'password' => Hash::make($request->password),
                'status' => $request->status,
                'created_by' => $auth,
                'remember_token' => $token
            ]
        );

        $memberCreate = Member::create(
            [
                'user_id' => $userCreate->id,
                'role_id' => 2,
                'created_by' => $auth,
            ]
        );

        $data = [
            "user" => $userCreate,
            "member" => $memberCreate,
        ];
        return response()->json($data);
    }

    public function edit(Request $request)
    {
        $edit = User::where("id", $request->id)->first();
        $email = $edit->email;
        $string = explode('.', $email, 2);
        $data = [
            "edit" => $edit,
            "string" => $string,
        ];

        return view("pages.management.member.components.edit", $data);
    }

    public function update(Request $request)
    {

        $user = User::with('hasInstitute')->whereHas('hasInstitute', function ($q) {
            $q->where('user_id', Auth::user()->id);
        })->first();

        if ($user == null) {
            return redirect()->route('management.member.index');
        } else {
            $institute = $user->hasInstitute->institute_slug;
        }

        $array = array($institute, $request->email);
        $string = implode('.', $array);

        if ($request->name) {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
            ]);
        } else {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ]);
        }

        $member = User::where("id", $request->id)->update([
            "name" => $request->name,
            "email" => $string
        ]);

        return response()->json($member);
    }

    public function delete($id)
    {
        $delete = User::where('id', $id)->delete();

        // check data deleted or not
        if ($delete == 1) {
            $success = true;
            $message = "Member Berhasil dihapus";
        } else {
            $success = true;
            $message = "Member tidak ditemukan!";
        }

        //  Return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

}