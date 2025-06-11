<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Dashboard', [
            'stats' => [
                'totalClients' => 0, // Implementar
                'totalQuotes' => 0,  // Implementar
                'totalRevenue' => 0, // Implementar
            ],
        ]);
    }
} 