<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Http\Requests\PageRequest;
use App\Models\Chapter;
use App\Models\Page;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Str;

class AdminPageController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.pages.index');
    }

    /**
     * @param string $slug
     * @return Application|Factory|View
     */
    public function edit(string $slug)
    {
        $page = Page::where('slug', '=', $slug)->first();

        return view('admin.pages.edit', compact('page'));
    }

    public function update(PageRequest $request, string $slug)
    {
        $page = Page::where('slug', '=', $slug)->first();

        $page->update([
            'name' => $request->get('name'),
            'slug' => Str::slug($request->get('name')),
            'content' => $request->get('content'),
        ]);

        return redirect()->route('admin.pages.index');
    }
}
