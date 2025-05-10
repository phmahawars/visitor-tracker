<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VisitorController extends Controller
{
    protected $api;

    public function __construct()
    {
        $this->api = "https://tvfix.harshmahawar.com/wp-json/visitor-tracker/v1";
    }

    public function logs(Request $request)
    {
        $page = $request->get('page', 1);
        $perPage = $request->get('perPage', 10);

        $response = Http::get("{$this->api}/logs", [
            'page' => $page,
            'per_page' => $perPage
        ]);

        $data = $response->json();

        // Cast each log entry to object for cleaner blade access like $log->ip_address
        $logs = collect($data['logs'] ?? [])->map(function ($log) {
            return (object) $log;
        });

        return view('admin.logs.index', [
            'logs' => $logs,
            'pagination' => $data['pagination'] ?? [],
        ]);
    }

    public function blockedIp()
    {
        $response = Http::get("{$this->api}/blocked-ips");
        // dd($response->json());   
        return view('admin.ips.index', ['ips' => $response->json()]);
    }


    public function blockIp(Request $request)
    {

        Http::post("{$this->api}/block-ip", ['ip_address' => $request->ip_address]);
        return back()->with('status', 'IP Blocked');
    }

    public function unblockIp(Request $request)
    {
        Http::post("{$this->api}/unblock-ip", ['ip_address' => $request->ip_address]);
        return back()->with('status', 'IP Unblocked');
    }
}
