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
        $news = $this->newsService->paginateNews($request->input('page', 1));
        $pagination = $news->toArray();

        if ($request->ajax()) {
            return response()->json([
                'news' => view('partials.news_list', compact('news'))->render(),
                'pagination' => view('partials.pagination', ['pagination' => $pagination])->render(),
            ]);
        }

        return view('pages.news', compact('news', 'pagination'));
    }

    public function show($id)
    {
        $newsItem = $this->newsService->getNewsById($id);
        return view('pages.news_detail', compact('newsItem'));
    }
}

