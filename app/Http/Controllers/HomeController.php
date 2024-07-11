<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Services\ProductService;
use App\Services\NewsService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected ProductService $productService;
    protected CategoryService $categoryService;
    protected NewsService $newsService;

    public function __construct(ProductService $productService, CategoryService $categoryService, NewsService $newsService) {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->newsService = $newsService;
    }

    public function index() {
        $categories = $this->categoryService->getAllCategories();
        $firstCategory = $categories->first();
        $products = $this->productService->getProductsByCategory($firstCategory->id);
        $hotProducts = $this->productService->getHotProductsByCategory($firstCategory->id);
        $news = $this->newsService->getLatestNews();
        return view('pages.home', compact('categories', 'products', 'firstCategory', 'hotProducts', 'news'));
    }
}
