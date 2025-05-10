<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
        $api = "https://tvfix.harshmahawar.com/wp-json/visitor-tracker/v1";

        $logs = Http::withOptions([
            'verify' => false,  // Disable SSL verification
        ])->get("$api/logs", ['per_page' => 5])->json();
        $allLogs = Http::withOptions([
            'verify' => false,  // Disable SSL verification
        ])->get("$api/logs", ['per_page' => 1])->json(); // Just to get total count

        $bots = Http::withOptions([
            'verify' => false,  // Disable SSL verification
        ])->get("$api/blocked-bots")->json();

        return view('admin.dashboard.index', [
            'totalVisitors' => $allLogs['pagination']['total_logs'] ?? 0,
            'blockedBots'   => count($bots ?? []),
            'blockedIps'    => collect($allLogs['logs'] ?? [])->where('blocked', 'true')->unique('ip_address')->count(),
            'latestVisitors' => $logs['logs'] ?? [],
        ]);
    }
}
