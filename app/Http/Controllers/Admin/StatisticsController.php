<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\StatisticsService;

class StatisticsController extends Controller
{
    protected $statisticsService;

    public function __construct(StatisticsService $statisticsService)
    {
        $this->statisticsService = $statisticsService;
    }

    public function index()
    {
        $years = range(date('Y'), date('Y') - 10);
        $bestSellers = $this->statisticsService->getBestSellers();
        $topRevenue = $this->statisticsService->getTopRevenue();

        return view('admin.statistics', compact('years', 'bestSellers', 'topRevenue'));
    }

    public function getRevenueByMonth($year)
    {
        $revenueData = $this->statisticsService->getMonthlyRevenue($year);
        return response()->json($revenueData);
    }
    
    public function getOrdersByMonth($year)
    {
        $orderData = $this->statisticsService->getMonthlyOrders($year);
        return response()->json($orderData);
    }
    
}
