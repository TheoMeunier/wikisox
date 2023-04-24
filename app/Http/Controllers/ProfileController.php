<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        /** @var User $user */
        $user = auth()->user();
        $counts = $user->loadCount(['books', 'chapters', 'pages']);

        $books = $user->books()->orderBy('created_at', 'desc')->take(4)->get();
        $chapters = $user->chapters()->orderBy('created_at', 'desc')->take(4)->get();
        $pages = $user->pages()->orderBy('created_at', 'desc')->take(4)->get();

        return view('profile.index', compact( 'counts', 'books', 'chapters', 'pages'));
    }

    /**
     * @return Application|Factory|View
     */
    public function edit()
    {
        return view('profile.edit');
    }
}
