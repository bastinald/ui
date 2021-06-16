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
        'form-check-input',
        'is-invalid' => $errors->has($model),
    ])->merge([
        'type' => 'radio',
        'name' => $model,
        'wire:model' . $bind => 'model.' . $model,
    ]);
@endphp

<div class="mb-3">
    @if($label)
        <label for="{{ $model }}" class="form-label">{{ $label }}</label>
    @endif

    @foreach($options as $optionValue => $optionLabel)
        <div class="form-check">
            @php($optionId = $model . '.' . $loop->index)

            <input {{ $attributes->merge(['id' => $optionId, 'value' => $optionValue]) }}>

            <label for="{{ $optionId }}" class="form-check-label">{{ $optionLabel }}</label>

            @if($loop->last)
                @error($model)
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            @endif
        </div>
    @endforeach
</div>
