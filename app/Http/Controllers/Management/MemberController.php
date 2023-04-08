<?php

namespace App\Http\Controllers\Management;

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
use App\Http\Controllers\Interface\ValidationController;
use App\Models\Institute;
use App\Models\Leader;
use Yajra\DataTables\Facades\DataTables;

class MemberController extends ManagementMasterController implements ValidationController
{
    private string $child = 'Member';
    private array $data;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->child;
            $get = $this->getMemberData();
            $this->data = [
                'parent' => $this->parent,
                'child' => $this->child,
                'institute' => $get['institute'],
                'member' => $get['member']
            ];
            return $next($request);
        });
    }

    private function getMemberData()
    {
        $institute = User::with('hasInstitute', 'hasLeader')->whereHas('hasInstitute', function ($q) {
            $q->where('created_by', Auth::user()->id);
        })->first();
        $leader = Leader::where('user_id', Auth::user()->id)->first();
        $member = Member::where('created_by', $leader->id)->count();

        return [
            'institute' => $institute,
            'member' => $member
        ];
    }

    public function showMember()
    {
        return view('pages.management.member.index', $this->data);
    }

    public function requestMemberData(Request $request)
    {
        if ($request->ajax()) {
            $auth = Auth::user()->hasLeader->first();
            $data = User::where('created_by', $auth->id)->orderBy('created_at', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()->addColumn('action', function ($data) {
                    $btn = '<div style="text-align: center; vertical-align: middle;">
                                <button title="Detail" class="btn btn-info btn-sm btn-outline-dark hovering shadow-sm"
                                 onclick="readMember(' . $data->id . ')">
                                    <i class="fa fa-address-book"></i>
                                </button>
                                <button title="Edit" class="btn btn-secondary btn-sm btn-outline-dark hovering shadow-sm"
                                 onclick="editMember(' . $data->id . ')" type="button" data-bs-toggle="modal" data-bs-target="#updateMember">
                                    <i class="fa fa-pencil"></i>
                                </button>
                                <button title="Delete" class="btn btn-danger btn-s btn-outline-dark hovering shadow-sm"
                                 onclick="deleteMember(' . $data->id . ')">
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

    public function searchMemberData(Request $req)
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
                'text' => $project->getUser->code . '/' . $project->getUser->name,
                'code' => $project->getUser->name
            ];
        }

        return response()->json($response);
    }

    public function createMember(Request $request)
    {
        $user = $this->data['institute'];

        if ($user == null) {
            return redirect()->route('management.member.index');
        } else {
            $institute = $user->hasInstitute->institute_slug;
        }

        $array = array($institute, $request->email);
        $string = implode('.', $array);
        $auth = Auth::user()->hasLeader->first();
        $token = Str::random(64);

        $last_member = User::where('created_by', Auth::user()->id)->orderBy('code', 'desc')->latest()->first();

        if ($last_member) {
            $last_code = $last_member->code;
            $last_character = substr($last_code, 0, 1);
            $last_number = substr($last_code, 1);

            if ($last_character === 'Z') {
                // jika karakter terakhir adalah Z, maka increment karakter kedua dan reset karakter pertama ke 'A'
                $new_character = 'A';
                $new_number = $last_number + 1;
            } else {
                // jika karakter terakhir bukan Z, maka increment karakter pertama dan gunakan nomor yang sama
                $new_character = chr(ord($last_character) + 1);
                $new_number = $last_number;
            }

            $new_code = $new_character . str_pad($new_number, strlen($last_number), '0', STR_PAD_LEFT);
        } else {
            $new_code = 'B'; // jika tidak ada $last_member, membuat kode awal dengan 'B'
        }

        $code = $new_code;


        $v_data = $this->validateDataCreate($request);
        $userCreate = User::create(
            [
                'uuid_user' => Str::uuid(),
                'role_id' => 2,
                'code' => $code,
                'name' => $v_data['name'],
                'email' => $string,
                'password' => Hash::make($v_data['password']),
                'status' => $v_data['status'],
                'created_by' => $auth->id,
                'remember_token' => $token
            ]
        );

        $memberCreate = Member::create(
            [
                'user_id' => $userCreate->id,
                'role_id' => 2,
                'created_by' => $auth->id,
            ]
        );

        $data = [
            'user' => $userCreate,
            'member' => $memberCreate,
        ];
        return response()->json(['success' => 'Anggota berhasil ditambahkan']);
    }

    public function validateDataCreate(Request $request)
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Rules\Password::defaults()],
            'status' => ['required', 'integer'],
        ], [
            'required' => 'Kolom :attribute harus diisi.',
            'string' => 'Kolom :attribute harus berupa teks.',
            'email' => 'Kolom :attribute harus diisi dengan format email.',
            'unique' => 'Kolom :attribute sudah ada data ini.',
            'max' => 'Kolom :attribute tidak boleh lebih dari :max karakter.',
            'integer' => 'Kolom :attribute harus diisi dengan angka.'
        ]);
    }

    public function editMember(Request $request)
    {
        $edit = User::where('id', $request->id)->first();
        $email = $edit->email;
        $string = explode('.', $email, 2);
        $data = [
            'edit' => $edit,
            'string' => $string,
        ];

        return view('pages.management.member.content.components.4-edit-member', $data);
    }

    public function updateMember(Request $request)
    {

        $user = $this->data['institute'];

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

    public function deleteMember($id)
    {
        $delete = User::where('uuid_user', $id)->delete();

        if ($delete == 1) {
            $success = true;
            $message = "Member Berhasil dihapus";
        } else {
            $success = true;
            $message = "Member tidak ditemukan!";
        }

        //  Return response
        return response()->json([
            's' => $success,
            'e' => $message,
        ]);
    }

    public function exportMemberData()
    {
        $institute = $this->data['institute']->hasInstitute()->first()->institute_slug;
        $member = $this->data['member'];
        $fileName = $member . '-member-' . $institute . '.xlsx';
        return Excel::download(new UsersExport(), $fileName);
    }
}
