@props([
    'model' => null,
    'label' => null,
])

@php
    $attributes = $attributes->class([
        'form-check-input',
        'is-invalid' => $errors->has($model),
    ])->merge([
        'type' => 'checkbox',
        'id' => $model,
        'wire:model.defer' => 'data.' . $model,
    ]);
@endphp

<div class="form-check mb-3">
    <input {{ $attributes }}>

    <label for="{{ $model }}" class="form-check-label">
        {{ $label }}
    </label>

    @error($model)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
