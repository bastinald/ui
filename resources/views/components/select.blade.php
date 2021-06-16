@props([
    'label' => null,
    'options' => [],
    'model',
    'lazy' => false,
])

@php
    $options = Arr::isAssoc($options) ? $options : array_combine($options, $options);

    if ($lazy) $bind = '.lazy';
    else $bind = '.defer';

    $attributes = $attributes->class([
        'form-select',
        'is-invalid' => $errors->has($model),
    ])->merge([
        'id' => $model,
        'wire:model' . $bind => 'model.' . $model,
    ]);
@endphp

<div class="mb-3">
    @if($label)
        <label for="{{ $model }}" class="form-label">{{ $label }}</label>
    @endif

    <select {{ $attributes }}>
        <option value=""></option>

        @foreach($options as $optionValue => $optionLabel)
            <option value="{{ $optionValue }}">{{ $optionLabel }}</option>
        @endforeach
    </select>

    @error($model)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
