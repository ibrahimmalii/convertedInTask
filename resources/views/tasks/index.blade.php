
@extends('layouts.layout')

@section('title', 'Tasks')

@section('content')
    <div class="form-group my-2 ms-auto">
        <a href="{{route('tasks.create')}}" class="btn btn-primary">Create New Task</a>
    </div>
    <table class="table table-hover mt-4">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Admin Name</th>
                <th scope="col">Assigned Name</th>
                <th scope="col">Created At</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tasks as $key => $task)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->assignedBy->name }}</td>
                    <td>{{ $task->assignedTo->name }}</td>
                    <td>{{ $task->created_at }}</td>
                </tr>
            @empty
                <p>No Tasks Available</p>
            @endforelse
        </tbody>
    </table>
    {{ $tasks->links() }}
@endsection
