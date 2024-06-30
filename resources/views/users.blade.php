@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2>User List</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Registration Time</th>
                        <th>Number of Purchases</th>
                        <th>Last Purchase Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>{{ $user->orders_count }}</td>
                            <td>{{ $user->last_order_date }}</td>
                            <td>{{ $user->orders_count >= 5 ? 'active' : 'inactive' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
