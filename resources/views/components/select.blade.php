@props([
    'options' => [],
    'data' => null,
    'lazy' => null,
    'defer' => null,
    'label' => null,
])

@php
    if ($lazy) $bind = '.lazy';
    else $bind = '.defer';

    $attributes = $attributes->class([
        'form-select',
        'is-invalid' => $errors->has($data),
    ])->merge([
        'id' => $data,
        'placeholder' => $label,
        'wire:model' . $bind => 'data.' . $data,
    ]);
@endphp

<div class="form-floating mb-3">
    <select {{ $attributes }}>
        <option value="">Select {{ $label }}</option>

        @foreach($options = Arr::isAssoc($options) ? $options : array_combine($options, $options) as $v => $l)
            <option value="{{ $v }}">{{ $l }}</option>
        @endforeach
    </select>

    <label for="{{ $data }}" class="form-label">
        {{ $label }}
    </label>

    @error($data)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
