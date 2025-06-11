<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $stats = [
            'activeQuotes' => $user->quotes()->where('status', 'active')->count(),
            'equipmentCount' => $user->equipment()->count(),
            'receiptCount' => $user->receipts()->count(),
        ];

        $recentActivity = $this->getRecentActivity($user);

        return Inertia::render('Client/Dashboard', [
            'stats' => $stats,
            'recentActivity' => $recentActivity,
        ]);
    }

    private function getRecentActivity($user)
    {
        // Aqui você pode implementar a lógica para buscar as atividades recentes
        // Por enquanto, retornaremos um array vazio
        return [];
    }
} 