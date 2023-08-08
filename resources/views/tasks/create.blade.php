@extends('layouts.layout')

@section('title', 'Create Task')

@section('content')
    <form method="POST" action="{{route('tasks.store')}}">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input
                type="text"
                class="form-control"
                id="title"
                name="title"
                placeholder="Enter title"
            >
            @error('title')
                <span class="text-danger bold">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group mt-4">
            <label for="description">Description</label>
            <textarea
                class="form-control"
                id="description"
                name="description"
                placeholder="Enter description"
                rows="10"
            ></textarea>
            @error('description')
                <span class="text-danger bold">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group mt-4">
            <label for="assigned_by_id">Assigned By</label>
            <select
                class="form-control"
                id="assigned_by_id"
                name="assigned_by_id"
            >
                @foreach($admins as $admin)
                    <option value="{{ $admin->id }}">{{ $admin->email }}</option>
                @endforeach
            </select>
            @error('assigned_by_id')
                <span class="text-danger bold">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group mt-4">
            <label for="assigned_to_id">Assigned To</label>
            <select
                class="form-control"
                id="assigned_to_id"
                name="assigned_to_id"
            >
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->email }}</option>
                @endforeach
            </select>
            @error('user_id')
                <span class="text-danger bold">{{ $message }}</span>
            @enderror
        </div>
        <div class="mt-4 text-center">
            <button type="submit" class="btn btn-primary w-50">Submit task</button>
        </div>
    </form>
@endsection
