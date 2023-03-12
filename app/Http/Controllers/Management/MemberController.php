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
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use App\Models\Institute;
use Yajra\DataTables\Facades\DataTables;

class MemberController extends Controller
{
    public function index()
    {
        $user = User::with('hasInstitute')->whereHas('hasInstitute', function ($q) {
            $q->where('user_id', Auth::user()->id);
        })->first();

        $member = User::with('hasInstitute')->whereHas('hasInstitute', function ($q) {
            $q->where('user_id', Auth::user()->id);
        })->where('created_by', Auth::user()->id)->get();

        $data = [
            "parent" => "Management",
            "child" => "Member",
            "institute" =>  $user,
            "members" => $member,
        ];
        return view('pages.management.member.index', $data);
    }

    public function getTable(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('created_by', Auth::user()->id)->orderBy("created_at", "DESC")->get();
             return DataTables::of($data)
                ->addIndexColumn()->addColumn('action', function ($data) {
                    $btn = '<div style="text-align: center; vertical-align: middle;">
                                <button title="Detail" class="btn btn-info btn-sm btn-outline-dark hovering shadow-sm" onclick="readMember(' . $data->id . ')">
                                    <i class="fa fa-address-book"></i>
                                </button>
                                <button title="Edit" class="btn btn-secondary btn-sm btn-outline-dark hovering shadow-sm" onclick="editMember(' . $data->id . ')" type="button" data-bs-toggle="modal" data-bs-target="#updateMember">
                                    <i class="fa fa-pencil"></i>
                                </button>
                                <button title="Delete" class="btn btn-danger btn-s btn-outline-dark hovering shadow-sm" onclick="deleteMember(' . $data->id . ')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>';
                    return $btn;
                })->addColumn('date', function ($data) {
                    $date = $data->last_seen;
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
                    $ip = $data->last_seen_ip;
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
                    $user_id = $data->id;
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
        $search = $req->q;
        $projects = Member::where('created_by', Auth::user()->id)
            ->with('getUser')->whereHas('getUser', function ($q) use ($search) {
                $q->where('created_by', Auth::user()->id)->orWhere('name', 'LIKE', '%' . $search . '%')
                ->orWhere('code', 'LIKE', '%' . $search . '%');
            })
            ->orderBy('created_at', 'ASC')
            ->get();

        $response = [];
        foreach ($projects as $project) {
            $response[] = [
                'id' => $project->getUser->code,
                'text' => $project->getUser->code.'/'.$project->getUser->name,
                'code' => $project->getUser->name
            ];
        }

        return response()->json($response);
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

        $last_member = User::where('created_by', Auth::user()->id)->orderBy('code', 'desc')
        ->latest()->first();
        $code = $last_member ? $last_member->code + 1 : 2;

        $userCreate = User::create(
            [
                'uuid_user' => Str::uuid(),
                'role_id' => 2,
                'code' => $code,
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
        return response()->json(['success' => 'Anggota berhasil ditambahkan']);
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

        return view("pages.management.member.content.components.4-edit-member", $data);
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

    public function export()
    {
        $institute = Institute::with('getUser')->where('user_id', Auth::user()->id)->first();
        $member = Member::where('created_by', Auth::user()->id)->count();
        $slug = $institute->institute_slug;
        $fileName = $slug.'-'.$member.'-member.xlsx';
        return Excel::download(new UsersExport(), $fileName);
    }

}
