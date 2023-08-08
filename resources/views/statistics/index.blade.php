
@extends('layouts.layout')

@section('title', 'Statistics')

@section('content')
    <table class="table table-hover mt-4">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">User Name</th>
            <th scope="col">Total Tasks</th>
        </tr>
        </thead>
        <tbody>
        @forelse($statistics as $key => $statistic)
            <tr>
                <th scope="row">{{ $key + 1 }}</th>
                <td>{{ $statistic->user->name }}</td>
                <td>{{ $statistic->total_tasks }}</td>
            </tr>
        @empty
            <p>No Statistics Available</p>
        @endforelse
        </tbody>
    </table>
@endsection
