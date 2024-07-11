<?php

namespace App\Http\Controllers;

use App\Services\NewsService;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    protected $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function index(Request $request)
    {
        $news = $this->newsService->paginateNews($request->input('page', 1), 4);
        return view('pages.news', compact('news'));
    }

    public function show($id)
    {
        $newsItem = $this->newsService->getNewsById($id);
        return view('pages.news_detail', compact('newsItem'));
    }
}

