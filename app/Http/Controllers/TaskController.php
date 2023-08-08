<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Jobs\UpdateOrCreateUserStatistics;
use App\Models\Statistic;
use App\Models\Task;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TaskController extends Controller
{
    public function index(): View
    {
        $tasks = Task::with(['assignedBy', 'assignedTo'])
                     ->select('id', 'title', 'assigned_by_id', 'assigned_to_id', 'created_at')
                     ->paginate(10);
        return view('tasks.index', compact('tasks'));
    }

    public function create(): View
    {
        $admins = cache()->remember('admins', 60 * 60, function () {
            return User::where('role_id', 1)->get();
        });

        $users = cache()->remember('users', 60 * 60, function () {
            return User::where('role_id', 2)->get();
        });
        return view('tasks.create', compact('admins', 'users'));
    }

    public function store(TaskRequest $request): RedirectResponse
    {
        $validatedTask = $request->validated();
        Task::create($validatedTask);

        UpdateOrCreateUserStatistics::dispatch($validatedTask['assigned_to_id']);
        return redirect()->route('tasks.index');
    }
}
