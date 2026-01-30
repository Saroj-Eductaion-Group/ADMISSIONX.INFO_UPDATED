@extends('administrator.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h2>SMS Logs</h2>
            
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Mobile</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Message ID</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logs as $log)
                    <tr>
                        <td>{{ $log->id }}</td>
                        <td>{{ $log->mobile }}</td>
                        <td>{{ Str::limit($log->message, 50) }}</td>
                        <td>
                            <span class="label label-{{ $log->status == 'sent' ? 'success' : 'danger' }}">
                                {{ $log->status }}
                            </span>
                        </td>
                        <td>{{ $log->message_id }}</td>
                        <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            {{ $logs->links() }}
        </div>
    </div>
</div>
@endsection