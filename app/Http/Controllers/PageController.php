<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageRequest;
use App\Models\Book;
use App\Models\Chapter;
use App\Models\Page;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Str;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PageController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index(string $slug, string $slugChapter)
    {
        $chapter = Chapter::query()
            ->with('pages')
            ->where('slug', '=', $slugChapter)
            ->first();

        $book = Book::where('slug', '=', $slug)
            ->first();

        return view('page.index', compact('book', 'chapter'));
    }

    /**
     * @return Application|Factory|View
     */
    public function show(string $slug, string $slugChapter, string $slugPage)
    {
        $book    = Book::where('slug', '=', $slug)->first();
        $chapter = Chapter::where('slug', '=', $slugChapter)->first();
        $page    = Page::where('slug', '=', $slugPage)->first();

        return view('page.show', compact('book', 'chapter', 'page'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create(string $slug, string $slugChapter)
    {
        $book = Book::where('slug', '=', $slug)
            ->first();

        $chapter = Chapter::where('slug', '=', $slugChapter)
            ->first();

        return view('page.create', compact('book', 'chapter'));
    }

    public function store(PageRequest $request, string $slug, string $slugChapter): RedirectResponse
    {
        $chapter = Chapter::where('slug', '=', $slugChapter)
            ->firstOrFail();

        Page::create([
            'name'       => $request->get('name'),
            'slug'       => Str::slug($request->get('name')),
            'content'    => $request->get('content'),
            'user_id'    => auth()->id(),
            'chapter_id' => $chapter->id,
        ]);

        return redirect()
            ->route('book.chapter.page.index', ['slug' => $slug, 'slugChapter' => $slugChapter])
            ->with('success', __('flash.page.create'));
    }

    /**
     * @return Application|Factory|View
     */
    public function edit(string $slug, string $slugChapter, string $slugPage)
    {
        $book = Book::where('slug', '=', $slug)
            ->first();

        $chapter = Chapter::where('slug', '=', $slugChapter)
            ->first();

        $page = Page::where('slug', '=', $slugPage)
            ->first();

        return view('page.edit', compact('book', 'chapter', 'page'));
    }

    public function update(PageRequest $request, string $slug): RedirectResponse
    {
        $page = Page::where('slug', '=', $slug)->firstOrFail();

        $page->update([
            'name'    => $request->get('name'),
            'slug'    => Str::slug($request->get('name')),
            'content' => $request->get('content'),
        ]);

        return redirect()
            ->route('book.chapter.page.show', [
                'slug'        => $page->chapter->book->slug,
                'slugChapter' => $page->chapter->slug,
                'slugPage'    => $page->slug,
            ])
            ->with('success', __('flash.page.update'));
    }

    public function delete(string $slug): RedirectResponse
    {
        $page = Page::query()->where('slug', '=', $slug)->firstOrFail();
        $page->delete();

        return redirect()
            ->route('book.chapter.page.index', [
                'slug'        => $page->chapter->book->slug,
                'slugChapter' => $page->chapter->slug,
            ])
            ->with('success', __('flash.page.delete'));
    }

    /**
     * @param string $slug
     * @return StreamedResponse
     */
    public function downloadHtml(string $slug): StreamedResponse
    {
        $page    = Page::query()->where('slug', '=', $slug)->first();

        if (!$page) {
            abort(404, 'Page not found');
        }

        return response()->streamDownload(function () use ($page, $slug) {
            echo Str::of($page->content)->markdown();;
        }, $slug . '.html');
    }

    /**
     * @param string $slug
     * @return StreamedResponse
     */
    public function downloadMarkdown(string $slug): StreamedResponse
    {
        $page    = Page::query()->where('slug', '=', $slug)->first();

        if (!$page) {
            abort(404, 'Page not found');
        }

        return response()->streamDownload(function () use ($page, $slug) {
            echo $page->content;
        }, $slug . '.md');
    }
}
