<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Interface\ValidationData;
use App\Models\{Institute, Leader};
use Illuminate\{Http\Request, Support\Facades\Auth};

class InstituteController extends ManagementController implements ValidationData
{
    public function createInstituteData(Request $request)
    {
        $user = Leader::where('user_id', Auth::user()->id)->first();
        $v_data = $this->validateDataCreate($request);
        Institute::create([
            'id' => random_int(1000000, 9999999),
            'leader_id' => $user->id,
            'institute_name' => $v_data['institute_name'],
            'created_by' => Auth::user()->id,
            'created_at' => now()
        ]);

        return response()->json(['success' => 'true']);
    }

    public function validateDataCreate(Request $request)
    {
        return $request->validate([
            'institute_name' => ['required', 'string', 'max:50'],
        ], [
            'required' => 'Kolom :attribute harus diisi.',
            'string' => 'Kolom :attribute harus berupa teks.',
            'max' => 'Kolom :attribute tidak boleh lebih dari :max karakter.',
        ]);
    }
}
