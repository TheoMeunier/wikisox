<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminFileController extends Controller
{
    public function __invoke()
    {
        return view('admin.images.index');
    }
}
