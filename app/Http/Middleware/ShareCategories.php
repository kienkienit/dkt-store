<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\CategoryService;

class ShareCategories
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

    protected $categoryService;
    
    public function __construct(CategoryService $categoryService) {
        $this->categoryService = $categoryService;
    }

    public function handle(Request $request, Closure $next)
    {
        $categories = $this->categoryService->getAllCategories();

        view()->share("categories", $categories);

        return $next($request);
    }
}
