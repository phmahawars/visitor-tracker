@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card text-bg-primary">
            <div class="card-body">
                <h5 class="card-title">Total Visitors</h5>
                <p class="card-text fs-4">{{ $totalVisitors ?? 0 }}</p>
                {{-- <a href="{{ route('logs.index') }}" class="btn btn-light btn-sm">View Logs</a> --}}
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card text-bg-danger">
            <div class="card-body">
                <h5 class="card-title">Blocked IPs</h5>
                <p class="card-text fs-4">{{ $blockedIps ?? 0 }}</p>
                {{-- <a href="{{ route('ips.index') }}" class="btn btn-light btn-sm">Manage IPs</a> --}}
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card text-bg-warning">
            <div class="card-body">
                <h5 class="card-title">Blocked Bots</h5>
                <p class="card-text fs-4">{{ $blockedBots ?? 0 }}</p>
                {{-- <a href="{{ route('bots.index') }}" class="btn btn-light btn-sm">Manage Bots</a> --}}
            </div>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">
        Latest Visitors
    </div>
    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead>
                <tr>
                    <th>IP Address</th>
                    <th>URL</th>
                    <th>Referrer</th>
                    <th>Location</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                @forelse($latestVisitors ?? [] as $log)
                    <tr>
                        <td>{{ $log['ip_address'] }}</td>
                        <td>{{ $log['visited_url'] }}</td>
                        <td>{{ $log['referrer'] }}</td>
                        <td>{{ $log['location'] }}</td>
                        <td>{{ $log['timestamp'] }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No visitor data available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
