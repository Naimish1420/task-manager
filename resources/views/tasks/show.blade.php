@extends('layouts.app')

@section('title', $task->title . ' - Task Manager')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-1">{{ $task->title }}</h1>
                <p class="text-muted mb-0">Task details</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-primary">
                    <i class="bi bi-pencil me-1"></i> Edit
                </a>
                <a href="{{ route('tasks.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <div class="row mb-4">
                    <div class="col-md-4">
                        <p class="text-muted small mb-1">Status</p>
                        <span class="badge {{ $task->status->badgeClass() }} fs-6">
                            {{ $task->status->label() }}
                        </span>
                    </div>
                    <div class="col-md-4">
                        <p class="text-muted small mb-1">Priority</p>
                        <span class="badge {{ $task->priority->badgeClass() }} fs-6">
                            {{ $task->priority->label() }}
                        </span>
                    </div>
                    <div class="col-md-4">
                        <p class="text-muted small mb-1">Due Date</p>
                        <p class="mb-0 fw-medium {{ $task->due_date->isPast() && $task->status->value === 'pending' ? 'text-danger' : '' }}">
                            <i class="bi bi-calendar3 me-1"></i>
                            {{ $task->due_date->format('F d, Y') }}
                        </p>
                    </div>
                </div>

                <div class="mb-4">
                    <p class="text-muted small mb-1">Description</p>
                    <p class="mb-0">{{ $task->description ?? 'No description provided.' }}</p>
                </div>

                @if ($task->image)
                    <div class="mb-4">
                        <p class="text-muted small mb-2">Task Image</p>
                        <img src="{{ $task->imageUrl() }}"
                             alt="{{ $task->title }}"
                             class="img-fluid rounded shadow-sm"
                             style="max-height: 400px;">
                    </div>
                @endif

                <div class="row text-muted small">
                    <div class="col-md-6">
                        <i class="bi bi-clock me-1"></i> Created: {{ $task->created_at->format('M d, Y h:i A') }}
                    </div>
                    <div class="col-md-6">
                        <i class="bi bi-pencil me-1"></i> Updated: {{ $task->updated_at->format('M d, Y h:i A') }}
                    </div>
                </div>
            </div>

            <div class="card-footer bg-white d-flex justify-content-end">
                <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                      onsubmit="return confirm('Are you sure you want to delete this task?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">
                        <i class="bi bi-trash me-1"></i> Delete Task
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
