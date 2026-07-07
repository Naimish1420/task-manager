@php
    use App\Enums\TaskPriority;
    use App\Enums\TaskStatus;
@endphp

<div class="mb-3">
    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
    <input type="text"
           class="form-control @error('title') is-invalid @enderror"
           id="title"
           name="title"
           value="{{ old('title', $task->title ?? '') }}"
           required>
    @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea class="form-control @error('description') is-invalid @enderror"
              id="description"
              name="description"
              rows="4">{{ old('description', $task->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="image" class="form-label">Task Image</label>
    @if (isset($task) && $task->image)
        <div class="mb-2">
            <img src="{{ $task->imageUrl() }}"
                 alt="{{ $task->title }}"
                 class="img-thumbnail"
                 style="max-height: 150px;">
        </div>
        <div class="form-check mb-2">
            <input type="checkbox"
                   class="form-check-input"
                   id="remove_image"
                   name="remove_image"
                   value="1"
                   {{ old('remove_image') ? 'checked' : '' }}>
            <label class="form-check-label text-danger" for="remove_image">Remove current image</label>
        </div>
    @endif
    <input type="file"
           class="form-control @error('image') is-invalid @enderror"
           id="image"
           name="image"
           accept="image/jpeg,image/png,image/jpg,image/gif,image/webp">
    <div class="form-text">Accepted formats: JPEG, PNG, GIF, WebP. Max size: 2MB.</div>
    @error('image')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <label for="due_date" class="form-label">Due Date <span class="text-danger">*</span></label>
        <input type="date"
               class="form-control @error('due_date') is-invalid @enderror"
               id="due_date"
               name="due_date"
               value="{{ old('due_date', isset($task) ? $task->due_date->format('Y-m-d') : '') }}"
               required>
        @error('due_date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label for="priority" class="form-label">Priority <span class="text-danger">*</span></label>
        <select class="form-select @error('priority') is-invalid @enderror"
                id="priority"
                name="priority"
                required>
            @foreach (TaskPriority::cases() as $priority)
                <option value="{{ $priority->value }}"
                    {{ old('priority', $task->priority->value ?? 'medium') === $priority->value ? 'selected' : '' }}>
                    {{ $priority->label() }}
                </option>
            @endforeach
        </select>
        @error('priority')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-4 mb-3">
        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
        <select class="form-select @error('status') is-invalid @enderror"
                id="status"
                name="status"
                required>
            @foreach (TaskStatus::cases() as $status)
                <option value="{{ $status->value }}"
                    {{ old('status', $task->status->value ?? 'pending') === $status->value ? 'selected' : '' }}>
                    {{ $status->label() }}
                </option>
            @endforeach
        </select>
        @error('status')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
