@props([
    'model' => null,
    'label' => null,
])

@php
    $attributes = $attributes->class([
        'form-control',
        'is-invalid' => $errors->has($model),
    ])->merge([
        'id' => $model,
        'placeholder' => $label,
        'wire:model.defer' => 'data.' . $model,
    ]);
@endphp

<div class="form-floating mb-3">
    <textarea {{ $attributes }}></textarea>

    <label for="{{ $model }}" class="form-label">
        {{ $label }}
    </label>

    @error($model)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
