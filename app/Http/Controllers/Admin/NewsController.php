<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\NewsService;
use Illuminate\Support\Facades\Log;

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
        $perPage = 5;
        $news = $this->newsService->paginateNews($page, $perPage);

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

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'published_date' => 'required|date',
                'image' => 'required|string'
            ]);

            $data = $request->all();
            $this->newsService->createNews($data);

            return response()->json(['success' => 'Tin tức đã được thêm thành công!']);
        } catch (\Exception $e) {
            Log::error('Error creating news: ' . $e->getMessage());
            return response()->json(['error' => 'Có lỗi xảy ra khi thêm tin tức.'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'published_date' => 'required|date',
                'image' => 'required|string'
            ]);

            $data = $request->all();
            $this->newsService->updateNews($id, $data);

            return response()->json(['success' => 'Tin tức đã được cập nhật thành công!']);
        } catch (\Exception $e) {
            Log::error('Error updating news: ' . $e->getMessage());
            return response()->json(['error' => 'Có lỗi xảy ra khi cập nhật tin tức.'], 500);
        }
    }

    public function delete($id)
    {
        try {
            $this->newsService->deleteNews($id);
            return response()->json(['success' => 'Tin tức đã được xóa thành công!']);
        } catch (\Exception $e) {
            Log::error('Error deleting news: ' . $e->getMessage());
            return response()->json(['error' => 'Có lỗi xảy ra khi xóa tin tức.'], 500);
        }
    }
}
