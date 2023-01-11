<?php

// routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;
// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('dashboard'));
});

Breadcrumbs::for('book', function (BreadcrumbTrail $trail, $book) {
    $trail->push($book->name, route('book.chapter.index', ['slug' => $book->slug]));
});

Breadcrumbs::for('chapter', function (BreadcrumbTrail $trail, $book, $chapter) {
    $trail->parent('book', $book);
    $trail->push($chapter->name, route('book.chapter.page.index', ['slug' => $book->slug, 'slugChapter' => $chapter->slug]));
});

Breadcrumbs::for('page', function (BreadcrumbTrail $trail, $book, $chapter, $page) {
    $trail->parent('chapter', $book, $chapter);
    $trail->push($page->name, route('book.chapter.page.show', ['slug' => $book->slug, 'slugChapter' => $chapter->slug, 'slugPage' => $page->slug]));
});
