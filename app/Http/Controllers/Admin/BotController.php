<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class BotController extends Controller
{
    protected $api;

    public function __construct()
    {
        $this->api = "https://tvfix.harshmahawar.com/wp-json/visitor-tracker/v1";
    }

    public function list()
    {
        $response = Http::get("{$this->api}/blocked-bots");
        return view('admin.bots.index', ['bots' => $response->json()]);
    }

    public function block(Request $request)
    {
        $response = Http::post("{$this->api}/block-bot", ['user_agent_pattern' => $request->user_agent]);
        print_r($response->json());
        return back()->with('status', 'Bot Blocked');
    }

    public function unblock(Request $request)
    {
        Http::post("{$this->api}/unblock-bot", ['id' => $request->id]);
        return back()->with('status', 'Bot Unblocked');
    }
}
