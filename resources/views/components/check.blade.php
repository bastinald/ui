@props([
    'data' => null,
    'lazy' => null,
    'defer' => null,
    'label' => null,
])

@php
    if ($lazy) $bind = '.lazy';
    else $bind = '.defer';

    $attributes = $attributes->class([
        'form-check-input',
        'is-invalid' => $errors->has($data),
    ])->merge([
        'type' => 'checkbox',
        'id' => $data,
        'wire:model' . $bind => 'data.' . $data,
    ]);
@endphp

<div class="form-check mb-3">
    <input {{ $attributes }}>

    <label for="{{ $data }}" class="form-check-label">
        {{ $label }}
    </label>

    @error($data)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
