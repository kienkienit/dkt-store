<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNewsRequest;
use Illuminate\Http\Request;
use App\Services\NewsService;

class NewsController extends Controller
{
    protected $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $news = $this->newsService->paginateNews($page);

        if ($request->ajax()) {
            return response()->json([
                'news' => view('partials-admin.news', compact('news'))->render()
            ]);
        }
        
        return view('admin.manage_news', compact('news'));
    }

    public function show($id)
    {
        $newsItem = $this->newsService->getNewsById($id);
        return response()->json($newsItem);
    }

    public function store(StoreNewsRequest $request)
    {
        $data = $request->all();
        $this->newsService->createNews($data);

        return json_response(true, ['message' => 'Tin tức đã được thêm thành công!']);
    }

    public function update(StoreNewsRequest $request, $id)
    {
        $data = $request->all();
        $this->newsService->updateNews($id, $data);

        return json_response(true, ['message' => 'Tin tức đã được cập nhật thành công!']);
    }

    public function delete($id)
    {
        $this->newsService->deleteNews($id);

        return json_response(true, ['message' => 'Tin tức đã được xóa thành công!']);
    }
}
