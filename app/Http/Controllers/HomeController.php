<?php

namespace App\Http\Controllers;

use App\Services\SearchService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct(
        private readonly SearchService $searchService
    ) {
    }

    public function search(Request $request): Application|Factory|View
    {
        $results      = [];
        $totalResults = 0;

        if ($request->get('search') >= 2) {
            $data = $this->searchService->searchWithPagination($request->get('search'), $request->get('page', 1));

            $results      = $data['results'];
            $totalResults = $data['totalResults'];
        }

        return view('home.search', compact('results', 'totalResults'));
    }
}
