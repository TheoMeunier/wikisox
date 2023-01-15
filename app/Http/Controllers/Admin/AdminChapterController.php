<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Http\Requests\ChapterRequest;
use App\Models\Chapter;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Str;

class AdminChapterController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.chapters.index');
    }

    /**
     * @param string $slug
     * @return Application|Factory|View
     */
    public function edit(string $slug)
    {
        $chapter = Chapter::where('slug', '=', $slug)->firstOrFail();

        return view('admin.chapters.edit', compact('chapter'));
    }

    /**
     * @param ChapterRequest $request
     * @param string $slug
     * @return RedirectResponse
     */
    public function update(ChapterRequest $request, string $slug): RedirectResponse
    {
        $chapter = Chapter::where('slug', '=', $slug)->firstOrFail();

        $chapter->update([
            'name' => $request->get('name'),
            'slug' => Str::slug($request->get('name')),
            'image' => $request->get('image'),
            'description' => $request->get('description'),
        ]);

        return redirect()->route('admin.chapters.index');
    }
}
