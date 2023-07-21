<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\GardenCenter;
use App\Models\Item;
use App\Models\MainCategory;
class DashboardController extends Controller
{
    public function dashboard()
    {
        $pagetitle = 'Dashboard';
        $main_category = MainCategory::where('status', true)->where('is_delete', 0)->count();
        $item = Item::where('status', true)->where('is_delete', 0)->count();
        $category = Category::where('status', true)->where('is_delete', 0)->count();
        $garden_center = GardenCenter::where('status', true)->where('is_delete', 0)->count();
        return view('dashboard', compact('pagetitle', 'garden_center', 'category', 'item', 'main_category'));
    }
}
