@props([
    'label',
    'model',
    'lazy' => false,
])

@php
    if ($lazy) $bind = '.lazy';
    else $bind = '.defer';

    $attributes = $attributes->class([
        'form-check-input',
        'is-invalid' => $errors->has($model),
    ])->merge([
        'type' => 'checkbox',
        'id' => $model,
        'wire:model' . $bind => 'model.' . $model,
    ]);
@endphp

<div class="form-check mb-3">
    <input {{ $attributes }}>

    <label for="{{ $model }}" class="form-check-label">{{ $label }}</label>

    @error($model)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
