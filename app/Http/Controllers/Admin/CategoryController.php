<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService) {
        $this->categoryService = $categoryService;
    }

    public function index() {
        $categories = $this->categoryService->getAllCategories();
        return view('categories.index', compact('categories'));
    }
}
