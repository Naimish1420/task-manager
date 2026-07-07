@extends('layouts.app')

@section('title', 'Dashboard - Task Manager')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-1">Dashboard</h1>
        <p class="text-muted mb-0">Welcome, {{ Auth::user()->name }}!</p>
    </div>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i> New Task
    </a>
</div>

<div class="row g-3">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 text-primary rounded p-3 me-3">
                        <i class="bi bi-list-task fs-4"></i>
                    </div>
                    <div>
                        <p class="text-muted small mb-0">Total Tasks</p>
                        <h3 class="mb-0">{{ $totalTasks }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="bg-warning bg-opacity-10 text-warning rounded p-3 me-3">
                        <i class="bi bi-clock fs-4"></i>
                    </div>
                    <div>
                        <p class="text-muted small mb-0">Pending Tasks</p>
                        <h3 class="mb-0">{{ $pendingTasks }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="bg-success bg-opacity-10 text-success rounded p-3 me-3">
                        <i class="bi bi-check-circle fs-4"></i>
                    </div>
                    <div>
                        <p class="text-muted small mb-0">Completed Tasks</p>
                        <h3 class="mb-0">{{ $completedTasks }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm mt-4">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h2 class="h5 mb-0">Recent Tasks</h2>
        <a href="{{ route('tasks.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-light">
                <tr>
                    <th>Title</th>
                    <th>Due Date</th>
                    <th>Priority</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($recentTasks as $task)
                    <tr>
                        <td>
                            <a href="{{ route('tasks.show', $task) }}" class="text-decoration-none">
                                {{ $task->title }}
                            </a>
                        </td>
                        <td>{{ $task->due_date->format('M d, Y') }}</td>
                        <td>
                            <span class="badge {{ $task->priority->badgeClass() }}">
                                {{ $task->priority->label() }}
                            </span>
                        </td>
                        <td>
                            <span class="badge {{ $task->status->badgeClass() }}">
                                {{ $task->status->label() }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">
                            No tasks yet.
                            <a href="{{ route('tasks.create') }}">Create your first task</a>.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
