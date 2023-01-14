<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminlogController extends Controller
{
    public function index()
    {
        return view('admin.logs.index');
    }
}
