<?php

namespace App\Http\Controllers\Management;

use App\Exports\UsersExport;
use App\Http\Controllers\Interface\ValidationData;
use App\Models\{Member, User};
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\{Str, Facades\Auth, Facades\Cache, Facades\Hash};
use Illuminate\Validation\{Rules, Rule};
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class MemberController extends ManagementController implements ValidationData
{
    private string $label = 'Member';
    private array $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function showMember()
    {
        $this->data = [
            'parent' => $this->page,
            'child' => $this->label,
            'institute' => $this->getInstituteData(),
            'member' => $this->getMemberData()
        ];
        return view('pages.management.member.index', $this->data);
    }

    public function requestMember(Request $request)
    {
        if ($request->ajax()) {
            $auth = Auth::user()->hasLeader->first();
            $data = User::where('deleted_by', null)->where('created_by', $auth->id)->orderBy('created_at', 'desc')->get();
            return DataTables::of($data)
                ->addIndexColumn()->addColumn('action', function ($data) {
                    $btn = '<div class="text-center">
                                <button title="Atur ulang password ' . $data->name . '" class="set-pass review-go btn-info btn-outline-dark" data-id="' . $data->id . '">
                                <i class="fa fa-key"></i>
                                </button>
                                <button title="Edit ' . $data->name . '" class="mb-2 review-go btn-warning btn-outline-dark"
                                 onclick="editMember(' . $data->id . ')" type="button" data-bs-toggle="modal" data-bs-target="#updateMember">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button title="Delete ' . $data->name . '" class="delete-member review-go btn-danger btn-outline-dark" data-id="' . $data->id . '">
                                <i class="fa fa-trash"></i>
                                </button>
                            </div>';
                    return $btn;
                })->addColumn('info', function ($data) {
                    $online = '<span class="text-success">Online</span>';
                    $offline = '<span class="text-secondary">Offline</span>';
                    $user_id = $data->id;
                    if (Cache::has('user-is-online-' . $user_id)) {
                        $status = $online;
                    } else {
                        $status = $offline;
                    }
                    $info = '<span>' . $status . '<span>';
                    return $info;
                })->addColumn('ip', function ($data) {
                    $ip = $data->last_seen_ip;
                    $info = '<small><span class="badge btn-outline-primary hovering badge-light-primary">IP Address: ' . $ip . '</span></small>';
                    $date = $data->last_seen;
                    $parse = Carbon::parse($date)->isoFormat('LLLL');
                    $danger_d = '<small><span class="badge btn-outline-danger hovering badge-light-danger">Belum ada riwayat Login</span>';
                    $info_d = '<small><span class="badge btn-outline-primary hovering badge-light-primary">' . $parse . '</span>';

                    if ($date == null && $ip == null) {
                        return $danger_d;
                    } else {
                        return $info_d . '<br>' . $info;
                    }
                })->addColumn('member', function ($data) {
                    $member = '(' . $data->code . ') ' . $data->name;
                    return $member;
                })->rawColumns(['action', 'info', 'ip', 'member'])->make(true);
        }
    }

    public function searchMember(Request $request)
    {
        $search = $request->q;
        $auth = Auth::user()->hasLeader->first();
        $projects = Member::where('created_by', $auth->id)
            ->whereHas('getUser', function ($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('code', 'LIKE', '%' . $search . '%')
                    ->where('deleted_at', null);
            })
            ->whereHas('getUser', function ($q) use ($search) {
                $q->where('deleted_at', null);
            })->orderBy('created_at', 'ASC')->get();

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
        $slug = $this->getInstituteData()['slug'];
        if ($slug == null) {
            return redirect()->route('management.member.index');
        } else {
            $institute = $slug;
        }

        $username = strtolower($request->username);
        $username = str_replace(' ', '', $username);

        $existingUsernames = User::where('username', 'LIKE', $username . '%')->pluck('username');

        $increment = 0;
        $newUsername = $username;
        while ($existingUsernames->contains($newUsername)) {
            $increment++;
            $newUsername = $username . $increment;
        }

        $username = $newUsername;

        $array = array($institute, $username);
        $string = implode('.', $array);
        $auth = Auth::user()->hasLeader->first();
        $token = Str::random(64);

        $last_member = User::where('created_by', $auth->id)->orderBy('code', 'desc')->first();

        if ($last_member) {
            $last_code = $last_member->code;
            $last_character = substr($last_code, 0, 1);
            $last_number = substr($last_code, 1);

            $missing_character = null;
            $next_character = $last_character;
            while ($next_character !== 'A') {
                $prev_character = chr(ord($next_character) - 1);
                if ($prev_character === 'A') {
                    break;
                }
                $prev_code = $prev_character . str_pad($last_number, strlen($last_number), '0', STR_PAD_LEFT);
                $code_exists = User::where('created_by', $auth->id)->where('code', $prev_code)->exists();
                if (!$code_exists) {
                    $missing_character = $prev_character;
                    break;
                }
                $next_character = $prev_character;
            }

            if ($missing_character !== null) {
                $new_character = $missing_character;
                $new_number = $last_number;
            } else {
                if ($last_character === 'Z') {
                    return response()->json(['error' => 'Anggota sudah mencapai batas Maksimum']);
                } else {
                    $new_character = chr(ord($last_character) + 1);
                    $new_number = $last_number;
                }
            }

            $new_code = $new_character . str_pad($new_number, strlen($last_number), '0', STR_PAD_LEFT);

            if ($last_number > 1 && $new_character !== 'B') {
                $missing_number = null;
                for ($i = 1; $i < $last_number; $i++) {
                    $code_exists = User::where('created_by', $auth->id)->where('code', $new_character . str_pad($i, strlen($last_number), '0', STR_PAD_LEFT))->exists();
                    if (!$code_exists) {
                        $missing_number = $i;
                        break;
                    }
                }
                if ($missing_number !== null) {
                    $new_code = $new_character . str_pad($missing_number, strlen($last_number), '0', STR_PAD_LEFT);
                }
            }
        } else {
            $new_code = 'B';
        }

        $v_data = $this->validateDataCreate($request);
        $userCreate = User::create(
            [
                'id' => random_int(1000000, 9999999),
                'uuid_user' => Str::uuid(),
                'role_id' => 2,
                'code' => $new_code,
                'name' => $v_data['name'],
                'username' => $string,
                'password' => Hash::make($v_data['password']),
                'created_by' => $auth->id,
                'created_at' => now(),
                'remember_token' => $token
            ]
        );

        Member::create(
            [
                'id' => random_int(1000000, 9999999),
                'user_id' => $userCreate->id,
                'created_by' => $auth->id,
                'created_at' => now()
            ]
        );
        return response()->json(['success' => 'Anggota berhasil ditambahkan']);
    }

    public function validateDataCreate(Request $request)
    {
        return $request->validate(
            [
                'name' => ['required', 'string', 'max:40'],
                'username' => ['required', 'string', 'max:100', 'unique:user'],
                'password' => ['required', Rules\Password::defaults()],
            ],
            [
                'required' => 'Tidak boleh kosong',
                'string' => 'Kolom :attribute harus berupa teks.',
                'unique' => 'Kolom :attribute sudah ada data ini.',
                'max' => 'Kolom :attribute tidak boleh lebih dari :max karakter.',
            ]
        );
    }

    public function editMember(Request $request)
    {
        $id = Auth::user()->hasLeader;
        $auth = $id[0]['id'];
        try {
            $hashedId = $request->id;
            $users = User::where('created_by', $auth)->get();
            $edit = null;
            foreach ($users as $user) {
                $hash = hash('sha256', $user->id);
                if ($hash === $hashedId) {
                    $edit = $user;
                    break;
                }
            }
            if (!$edit) {
                return response()->json(['error' => 'Pengguna tidak ditemukan'], 404);
            }
            $username = $edit->username;
            $string = explode('.', $username, 2);
            $data = [
                'edit' => $edit,
                'string' => $string,
            ];
            return view('pages.management.member.content.components.4-edit-member', $data);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Data tidak berhasil diubah'], 500);
        }
    }

    public function updateMember(Request $request)
    {
        try {
            $slug = $this->getInstituteData()['slug'];
            if (!$slug) {
                return redirect()->route('management.member.index');
            }
            $institute = $slug;
            $string = $institute . '.' . $request->username;
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255', Rule::unique('user')->ignore($request->id)],
            ]);
            try {
                User::where('id', $request->id)->update([
                    'name' => $request->name,
                    'username' => $string,
                    'updated_by' => Auth::user()->id,
                    'updated_at' => now()
                ]);
                return response()->json(['success' => 'Data berhasil diperbarui!']);
            } catch (\Illuminate\Database\QueryException $ex) {
                $error_code = $ex->errorInfo[1];
                if ($error_code == 1062) {
                    return response()->json(['error' => 'Username telah digunakan. Silakan gunakan username lain.']);
                } else {
                    return response()->json(['error' => $ex->getMessage()]);
                }
            }
            return response()->json(['success' => 'Data berhasil diupdate!']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function setPasswordMember(Request $request)
    {
        $set = User::find($request->id)->update([
            'password' => Hash::make('12345678'),
            'deleted_at' => now()
        ]);

        if ($set == 1) {
            $e = true;
            $message = "Password Member berhasil diperbarui!";
        } else {
            $e = false;
            $message = "Proses Tidak berjalan!";
        }
        return response()->json(['e' => $e, 'status' => $message]);
    }

    public function deleteMember(Request $request)
    {
        $delete = User::find($request->id)->update([
            'deleted_by' => Auth::user()->id,
            'deleted_at' => now()
        ]);

        if ($delete == 1) {
            $e = true;
            $message = "Member Berhasil dihapus!";
        } else {
            $e = false;
            $message = "Proses Tidak berjalan!";
        }
        return response()->json(['e' => $e, 'status' => $message]);
    }

    public function exportMember()
    {
        $member = $this->getMemberData();
        if (null !== $this->getInstituteData()['institute']) {
            $ins = $this->getInstituteData()['institute'];
            $institute = $ins['institute_name'];
            $ins_array = explode(' ', $institute);
            $prefix = Str::of($ins_array[0])->slug('');
        } else {
            $prefix = 'slr';
        }
        $currentDateTime = date('His-dmY');
        $fileName = $member . '-member-' . $prefix . '-' . $currentDateTime . '.xlsx';
        return Excel::download(new UsersExport(), $fileName);
    }
}
