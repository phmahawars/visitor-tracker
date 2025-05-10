@extends('admin.layouts.app')

@section('content')
<style>
  tbody tr td, thead tr th{
        white-space: nowrap;

  }
</style>
  
<div class="container-fluid py-4">
    <h1 class="mb-4">Visitor Logs</h1>

    <div class="table-responsive">
        <table id="visitorTable" class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>IP</th>
                    <th>User Agent</th>
                    <th>URL</th>
                    <th>Referrer</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Country</th>
                    <th>Zip</th>
                    <th>Internet Service Provider</th>
                    <th>Organization</th>
                    <th>Autonomous System info</th>
                    <th>Is VPN</th>
                    <th>Blocked?</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($logs as $log)
{{-- id
ip_address
user_agent
visited_url
referrer
timestamp
country
countryCode
region
regionName
city
zip
isp
org
as
vpn --}}
                <tr>
                    <td>{{ $log->id }}</td>  <!-- Change from $log['ip_address'] to $log->ip_address -->
                    <td>{{ $log->ip_address }}</td>  <!-- Change from $log['ip_address'] to $log->ip_address -->
                    <td class="text-break">{{ $log->user_agent }}</td>  <!-- Same change for other fields -->
                    <td class="text-break">{{ $log->visited_url }}</td>
                    <td class="text-break">{{ $log->referrer }}</td>
                    <td>{{ $log->city }}</td>
                    <td>{{ $log->regionName }}, {{ $log->region }}</td>
                    <td>{{ $log->country }}, {{ $log->countryCode }}</td>
                    <td>{{ $log->zip }}</td>
                    <td>{{ $log->isp }}</td>
                    <td>{{ $log->org }}</td>
                    <td>{{ $log->as }}</td>
                    <td>
                      <span class="badge bg-{{ $log->vpn == 1 ? 'danger' : 'success' }}">
                            {{ $log->vpn == 1 ? 'Yes' : 'No' }}
                        </span>
                    </td>
                    <td>
                        <!-- Display blocked status -->
                        <span class="badge bg-{{ $log->blocked == 'true' ? 'danger' : 'success' }}">
                            {{ $log->blocked === 'true' ? 'Yes' : 'No' }}
                        </span>
                    </td>
                    <td>
                        <!-- Block or Unblock actions -->
                        @if($log->blocked === 'false')
                            <form method="POST" action="{{ route('ips.block') }}" class="d-inline">
                                @csrf
                                <input type="hidden" name="ip_address" value="{{ $log->ip_address }}">
                                <button type="submit" class="btn btn-sm btn-outline-danger">Block</button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('ips.unblock') }}" class="d-inline">
                                @csrf
                                <input type="hidden" name="ip_address" value="{{ $log->ip_address }}">
                                <button type="submit" class="btn btn-sm btn-outline-success">Unblock</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    @if($pagination['total_pages'] > 1)
        <nav>
            <ul class="pagination justify-content-center mt-3">
                @for($i = 1; $i <= $pagination['total_pages']; $i++)
                    <li class="page-item {{ $i == $pagination['current_page'] ? 'active' : '' }}">
                        <a class="page-link" href="{{ url()->current() }}?page={{ $i }}">{{ $i }}</a>
                    </li>
                @endfor
            </ul>
        </nav>
    @endif
</div>
<script>
    // $(document).ready(function () {
    //     $('#visitorTable').DataTable({
    //         responsive: true,
    //         paging: false,         // 👈 disables pagination
    //         searching: true,
    //         // ordering: true,
    //         info: false,           // 👈 hides "Showing X of Y entries"
    //         language: {
    //             searchPlaceholder: "Search records...",
    //             search: ""
    //         }
    //     });
    // });
</script>
@endsection
