<?php

namespace App\Http\Controllers\Interface;

use Illuminate\Http\Request;

interface CategoryController
{
    public function createCategory(Request $request);

    public function getCategory(Request $req);
}
