<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\User;
use App\Models\Category;
use App\Models\VisitForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function index()
    {
        $totalWisata = Destination::count();
        $totalUsers = User::where('role', 'user')->count();
        $totalAdmins = User::where('role', 'admin')->count();
        $recentWisata = Destination::latest()->take(5)->get();
        $recentUsers = User::where('role', 'user')->latest()->take(5)->get();

        // Data untuk grafik pengunjung berdasarkan kategori
        $visitorsByCategory = Category::select('categories.name', 'categories.id')
            ->selectRaw('COALESCE(SUM(CASE
                WHEN visit_forms.visit_type = "sendirian" THEN 1
                WHEN visit_forms.visit_type = "rombongan" THEN visit_forms.group_size
                ELSE 0
            END), 0) as total_visitors')
            ->leftJoin('destinations', 'categories.id', '=', 'destinations.category_id')
            ->leftJoin('visit_forms', 'destinations.id', '=', 'visit_forms.destination_id')
            ->groupBy('categories.id', 'categories.name')
            ->orderBy('categories.name')
            ->get();

        return view('admin.dashboard', compact(
            'totalWisata',
            'totalUsers',
            'totalAdmins',
            'recentWisata',
            'recentUsers',
            'visitorsByCategory'
        ));
    }
}
