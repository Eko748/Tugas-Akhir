<?php

namespace App\Http\Controllers\Interface;

use Illuminate\Http\Request;

interface ValidationController
{
    public function validateDataCreate(Request $request);
}
