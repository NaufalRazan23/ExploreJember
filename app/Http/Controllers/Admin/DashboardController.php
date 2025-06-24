<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\User;
use Illuminate\Http\Request;

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

        return view('admin.dashboard', compact(
            'totalWisata',
            'totalUsers',
            'totalAdmins',
            'recentWisata',
            'recentUsers'
        ));
    }
}
