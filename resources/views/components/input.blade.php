@props([
    'model' => null,
    'label' => null,
])

@php
    $attributes = $attributes->class([
        'form-control',
        'is-invalid' => $errors->has($model),
    ])->merge([
        'type' => $type = $attributes->get('type', 'text'),
        'inputmode' => $type == 'number' ? 'numeric' : $type,
        'id' => $model,
        'placeholder' => $label,
        'wire:model.defer' => 'data.' . $model,
    ]);
@endphp

<div class="form-floating mb-3">
    <input {{ $attributes }}>

    <label for="{{ $model }}" class="form-label">
        {{ $label }}
    </label>

    @error($model)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
