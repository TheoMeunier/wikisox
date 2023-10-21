<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Chapter;
use App\Models\Page;
use App\Models\User;

class RestoreDataService
{
    public function restoreUser(int $id): void
    {
        $user = User::withTrashed()
            ->where('id', $id)
            ->firstOrFail();

        $user->restore();
    }

    public function restorePage(int $id): void
    {
        $page = Page::withTrashed()
            ->where('id', $id)
            ->firstOrFail();

        $page->restore();
    }

    public function restoreChapter(int $id): void
    {
        $chapter = Chapter::withTrashed()
            ->where('id', $id)
            ->firstOrFail();

        $chapter->restore();

        $pages = Page::withTrashed()
            ->where('chapter_id', '=', $id)
            ->get();

        foreach ($pages as $page) {
            $page->restore();
        }
    }

    public function restoreBook(int $id): void
    {
        $book = Book::withTrashed()
            ->where('id', $id)
            ->firstOrFail();

        $book->restore();

        $chapters = Chapter::withTrashed()
            ->where('book_id', '=', $id)
            ->get();

        foreach ($chapters as $chapter) {
            $chapter->restore();

            $pages = Page::withTrashed()
                ->where('chapter_id', '=', $chapter->id)
                ->get();

            foreach ($pages as $page) {
                $page->restore();
            }
        }
    }
}
