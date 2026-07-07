@extends('layouts.app')

@section('title', 'Tasks - Task Manager')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-1">My Tasks</h1>
        <p class="text-muted mb-0">Manage all your tasks in one place</p>
    </div>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i> New Task
    </a>
</div>

<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form action="{{ route('tasks.index') }}" method="GET" class="row g-2">
            <div class="col-md-10">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="text"
                           class="form-control"
                           name="search"
                           placeholder="Search by title or description..."
                           value="{{ $search }}">
                </div>
            </div>
            <div class="col-md-2 d-grid">
                <button type="submit" class="btn btn-outline-primary">Search</button>
            </div>
        </form>
        @if ($search)
            <div class="mt-2">
                <a href="{{ route('tasks.index') }}" class="small text-decoration-none">
                    <i class="bi bi-x-circle me-1"></i> Clear search
                </a>
            </div>
        @endif
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-light">
                <tr>
                    <th style="width: 60px;">Image</th>
                    <th>Title</th>
                    <th>Due Date</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tasks as $task)
                    <tr>
                        <td>
                            @if ($task->image)
                                <img src="{{ $task->imageUrl() }}"
                                     alt="{{ $task->title }}"
                                     class="rounded"
                                     style="width: 48px; height: 48px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center text-muted"
                                     style="width: 48px; height: 48px;">
                                    <i class="bi bi-image"></i>
                                </div>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('tasks.show', $task) }}" class="text-decoration-none fw-medium">
                                {{ $task->title }}
                            </a>
                        </td>
                        <td>
                            <span class="{{ $task->due_date->isPast() && $task->status->value === 'pending' ? 'text-danger' : '' }}">
                                {{ $task->due_date->format('M d, Y') }}
                            </span>
                        </td>
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
                        <td class="text-end">
                            <a href="{{ route('tasks.show', $task) }}" class="btn btn-sm btn-outline-secondary" title="View">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Are you sure you want to delete this task?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-5">
                            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                            @if ($search)
                                No tasks found matching "{{ $search }}".
                            @else
                                No tasks yet. <a href="{{ route('tasks.create') }}">Create your first task</a>.
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($tasks->hasPages())
        <div class="card-footer bg-white">
            {{ $tasks->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
