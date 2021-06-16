@props([
    'label' => null,
    'type',
    'model',
    'lazy' => false,
    'debounce' => false,
])

@php
    if ($type == 'number') $inputmode = 'decimal';
    else if (in_array($type, ['tel', 'search', 'email', 'url'])) $inputmode = $type;
    else $inputmode = 'text';

    if ($lazy) $bind = '.lazy';
    else if (ctype_digit($debounce)) $bind = '.debounce.' . $debounce . 'ms';
    else if ($debounce) $bind = '';
    else $bind = '.defer';

    $attributes = $attributes->class([
        'form-control',
        'is-invalid' => $errors->has($model),
    ])->merge([
        'type' => $type,
        'inputmode' => $inputmode,
        'id' => $model,
        'wire:model' . $bind => 'model.' . $model,
    ]);
@endphp

<div class="mb-3">
    @if($label)
        <label for="{{ $model }}" class="form-label">{{ $label }}</label>
    @endif

    <input {{ $attributes }}>

    @error($model)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
