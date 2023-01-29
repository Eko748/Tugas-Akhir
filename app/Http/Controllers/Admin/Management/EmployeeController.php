<?php

namespace App\Http\Controllers\Admin\Management;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\User;
use App\Models\UserStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    public function index()
    {
        $user = User::with('userStores')->whereHas('userStores', function ($q) {
            $q->where('user_id', Auth::user()->id);
        })->first();

        $coba = User::all();

        $data = [
            "parent" => "Management",
            "child" => "Karyawan",
            "store" =>  $user,
            "coba" => $coba,
        ];
        return view('admin.pages.management.employee.index', $data);
    }

    public function getTable(Request $request)
    {
        if ($request->ajax()) {
            $data = User::where('created_by', Auth::user()->id)->orderBy("created_at", "DESC")->get();
            return DataTables::of($data)
                ->addIndexColumn()->addColumn('action', function ($data) {
                    $btn = '<div style="text-align: center; vertical-align: middle;">
                                <button title="Detail" class="btn btn-primary btn-sm btn-outline-dark hovering shadow-sm" onclick="readEmployee(' . $data->id . ')">
                                    <i class="fa fa-address-book"></i>
                                </button>
                                <button title="Edit" class="btn btn-success btn-sm btn-outline-dark hovering shadow-sm" onclick="editEmployee(' . $data->id . ')" type="button" data-bs-toggle="modal" data-bs-target="#updateEmployee">
                                    <i class="fa fa-pencil"></i>
                                </button>
                                <button title="Delete" class="btn btn-danger btn-s btn-outline-dark hovering shadow-sm" onclick="deleteEmployee(' . $data->id . ')">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>';
                    return $btn;
                    // <button class="btn btn-danger" onclick="deleteEmployee({{$user->id}})"></button>
                })->addColumn('date', function ($data) {
                    $date = $data->last_seen;
                    $parse = Carbon::parse($date)->isoFormat('LLLL');
                    $danger = '<span class="badge btn-outline-primary hovering badge-light-primary">Belum ada riwayat Login</span>';
                    $info = '<span class="badge btn-outline-success hovering badge-light-success">' . $parse . '</span>';

                    if ($date == null) {
                        return $danger;
                    } else {
                        return $info;
                    }
                    return $date;
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
                })->rawColumns(['action', 'date', 'info'])->make(true);
        }
    }

    public function getUser(Request $req)
    {
    	$users = [];

        if($req->has('q')){
            $search = $req->q;
            $users = User::select("id", "name", "email")
            		  ->where('name', 'LIKE', "%$search%")
            		  ->get();
        }
        return response()->json($users);
    }

    public function create(Request $request)
    {
        $user = User::with('userStores')->whereHas('userStores', function ($q) {
            $q->where('user_id', Auth::user()->id);
        })->first();

        if ($user == null) {
            return redirect()->route('management.employee.index');
        } else {
            $store = $user->userStores->store_slug;
        }

        $array = array($store, $request->email);
        $string = implode('.', $array);

        $auth = Auth::user()->id;
        $token = Str::random(64);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Rules\Password::defaults()],
            'status' => ['required', 'integer'],
        ]);

        $employee = User::create(
            [
                'id_role' => 2,
                'name' => $request->name,
                'email' => $string,
                'password' => Hash::make($request->password),
                'status' => $request->status,
                'created_by' => $auth,
                'remember_token' => $token
            ]
        );

        return response()->json($employee);
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

        return view("admin.pages.management.employee.components.edit", $data);
    }

    public function update(Request $request)
    {

        $user = User::with('userStores')->whereHas('userStores', function ($q) {
            $q->where('user_id', Auth::user()->id);
        })->first();

        if ($user == null) {
            return redirect()->route('management.employee.index');
        } else {
            $store = $user->userStores->store_slug;
        }

        $array = array($store, $request->email);
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

        $employee = User::where("id", $request->id)->update([
            "name" => $request->name,
            "email" => $string
        ]);

        return response()->json($employee);
    }

    public function delete($id)
    {
        $delete = User::where('id', $id)->delete();

        // check data deleted or not
        if ($delete == 1) {
            $success = true;
            $message = "Employee Berhasil dihapus";
        } else {
            $success = true;
            $message = "Employee tidak ditemukan!";
        }

        //  Return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }

    public function storeToko(Request $request)
    {
        $request->validate([
            "store_name" => "required"
        ]);

        UserStore::create([
            "user_id" => Auth::user()->id,
            "store_name" => $request->store_name,
            "store_slug" => Str::of($request->store_name)->slug("")
        ]);

        return response()->json(["success" => "true"]);
    }
}
