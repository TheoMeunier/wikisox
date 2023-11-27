<?php

namespace App\Services;

use App\Models\Book;
use App\Models\Chapter;
use App\Models\Page;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Str;

class SearchService
{
    public function search(string $search, bool $is_modal = false): array
    {
        $data = [];

        $pageQuery    = $this->buildQuery('page', $search);
        $chapterQuery = $this->buildQuery('chapter', $search);
        $bookQuery    = $this->buildQuery('book', $search);

        $totalResults = $pageQuery
            ->union($chapterQuery)
            ->union($bookQuery)
            ->count();

        $q = $pageQuery
            ->union($chapterQuery)
            ->union($bookQuery);

        if ($is_modal) {
            $q->take(5);
        }

        /** @var Page|Chapter|Book $item */
        foreach ($q->get() as $item) {
            $data[] = [
                'name'        => $item->name,
                'url'         => $this->getUrl($item),
                'type'        => $item->type ?? '',
                'description' => Str::limit($item->description ?? '', 110),
            ];
        }

        return [
            'results'      => $data,
            'totalResults' => $totalResults,
        ];
    }

    public function searchWithPagination(string $search, int $page = 1): array
    {
        $data       = $this->search($search);
        $collection = new Collection($data['results']);

        $pagine = new LengthAwarePaginator(
            $collection->forPage($page, 10),
            $collection->count(),
            10,
            $page,
            [
                'path' => route('home.search'),
            ]
        );

        return [
            'results'      => $pagine->withQueryString(),
            'totalResults' => $data['totalResults'],
        ];
    }

    private function getUrl(mixed $item): string
    {
        switch ($item->type) {
            case 'page':
                return route('book.chapter.page.show', [
                    'slug'        => $item->book_slug,
                    'slugChapter' => $item->chapter_slug,
                    'slugPage'    => Str::slug($item->name),
                ]);
            case 'chapter':
                return route('book.chapter.page.index', [
                    'slug'        => $item->book_slug,
                    'slugChapter' => $item->chapter_slug,
                ]);
            case 'book':
                return route('book.chapter.index', [
                    'slug' => Str::slug($item->name),
                ]);
            default:
                return '';
        }
    }

    private function buildQuery(string $type, string $search): Builder
    {
        if ($type === 'page') {
            $builder = Page::query()
                ->join('chapters', 'chapters.id', '=', 'pages.chapter_id')
                ->join('books', 'books.id', '=', 'chapters.book_id')
                ->select(
                    'pages.name',
                    'pages.id',
                    'pages.content as description',
                    'chapters.slug as chapter_slug',
                    'books.slug as book_slug'
                )
                ->where('pages.name', 'LIKE', "%{$search}%");
        } elseif ($type === 'chapter') {
            $builder = Chapter::query()
                ->join('books', 'books.id', '=', 'chapters.book_id')
                ->select(
                    'chapters.name',
                    'chapters.id',
                    'chapters.slug as chapter_slug',
                    'chapters.description',
                    'books.slug as book_slug'
                )
                ->where('chapters.name', 'LIKE', "%{$search}%");
        } else {
            $builder = Book::query()
                ->select(
                    'books.name',
                    'books.id',
                    'books.description',
                    'books.slug as book_slug'
                )
                ->addSelect(DB::raw("'' as chapter_slug"))
                ->where('books.name', 'LIKE', "%{$search}%");
        }

        $builder->addSelect(DB::raw("'$type' as type"));

        return $builder;
    }
}
