@props([
    'data' => null,
    'instant' => null,
    'lazy' => null,
    'debounce' => null,
    'defer' => null,
    'label' => null,
])

@php
    if ($instant) $bind = '';
    else if ($lazy) $bind = '.lazy';
    else if ($debounce) $bind = '.debounce.' . $debounce . 'ms';
    else $bind = '.defer';

    $attributes = $attributes->class([
        'form-control',
        'is-invalid' => $errors->has($data),
    ])->merge([
        'id' => $data,
        'placeholder' => $label,
        'wire:model' . $bind => 'data.' . $data,
    ]);
@endphp

<div class="form-floating mb-3">
    <textarea {{ $attributes }}></textarea>

    <label for="{{ $data }}" class="form-label">
        {{ $label }}
    </label>

    @error($data)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
