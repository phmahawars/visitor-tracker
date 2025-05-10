@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <h1 class="mb-4">Blocked Bots</h1>

    <div class="mb-4">
        <form method="POST" action="{{route('bots.block')}}" class="row g-3 align-items-center">
            @csrf
            <div class="col-auto">
                <input type="text" name="user_agent" class="form-control" placeholder="User Agent" required>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Add Bot</button>
            </div>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>User Agent</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bots as $bot)
                    <tr>
                        <td>{{ $bot['id'] }}</td>
                        <td class="text-break">{{ $bot['user_agent_pattern'] }}</td>
                        <td>
                            <form method="POST" action="/unblock-bot" class="d-inline">
                                @csrf
                                <input type="hidden" name="id" value="{{ $bot['id'] }}">
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
