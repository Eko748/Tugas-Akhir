<?php

namespace App\Http\Controllers\Interface;

use Illuminate\Http\Request;

interface ValidationData
{
    public function validateDataCreate(Request $request);
}
