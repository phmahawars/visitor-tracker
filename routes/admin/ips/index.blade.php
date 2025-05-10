@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <h1 class="mb-4">Blocked IP Address</h1>

    <div class="mb-4">
        <form method="POST" action="{{ route('ips.block') }}" class="row g-3 align-items-center">
            @csrf
            <div class="col-auto">
                <input type="text" name="ip_address" class="form-control" placeholder="192.0.2.1" required>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Add IP Address</button>
            </div>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>IP Address</th>
                    <th>blocked_at</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ips as $ip)
                    <tr>
                        <td>{{ $ip['id'] }}</td>
                        <td class="text-break">{{ $ip['ip_address'] }}</td>
                        <td class="text-break">{{ $ip['blocked_at'] }}</td>
                        <td>
                            <form method="POST" action="{{ route('ips.unblock') }}" class="d-inline">
                                @csrf
                                <input type="hidden" name="ip_address" value="{{ $ip['ip_address'] }}">
                                <button type="submit" class="btn btn-sm btn-outline-danger">Unblock</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
