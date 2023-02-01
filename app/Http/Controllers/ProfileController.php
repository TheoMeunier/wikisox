<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class ProfileController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('profile.index');
    }

    /**
     * @return Application|Factory|View
     */
    public function edit()
    {
        return view('profile.edit');
    }
}
