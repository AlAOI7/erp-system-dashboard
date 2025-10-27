<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalUsers = User::count();
        $lowStockProducts = Product::where('quantity', '<=', 10)->where('quantity', '>', 0)->count();
        $outOfStockProducts = Product::where('quantity', '<=', 0)->count();
        
        $recentProducts = Product::with('category')->latest()->take(5)->get();
        
        $lowStockItems = Product::where('quantity', '<=', 10)
            ->where('quantity', '>', 0)
            ->orderBy('quantity')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'user',
            'totalProducts', 
            'totalCategories', 
            'totalUsers',
            'lowStockProducts',
            'outOfStockProducts',
            'recentProducts',
            'lowStockItems'
        ));
    }
}