<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Http\Requests\ChapterRequest;
use App\Models\Chapter;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
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
        $chapter = Chapter::where('slug', '=', $slug)->first();

        return view('admin.chapters.edit', compact('chapter'));
    }

    public function update(ChapterRequest $request, string $slug)
    {
        $chapter = Chapter::where('slug', '=', $slug)->first();

        $chapter->update([
            'name' => $request->get('name'),
            'slug' => Str::slug($request->get('name')),
            'image' => $request->get('image'),
            'description' => $request->get('description'),
        ]);

        return redirect()->route('admin.chapters.index');
    }
}
