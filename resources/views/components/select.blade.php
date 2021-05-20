@props([
    'options' => [],
    'model' => null,
    'label' => null,
])

@php
    $attributes = $attributes->class([
        'form-select',
        'is-invalid' => $errors->has($model),
    ])->merge([
        'id' => $model,
        'placeholder' => $label,
        'wire:model.defer' => 'data.' . $model,
    ]);
@endphp

<div class="form-floating mb-3">
    <select {{ $attributes }}>
        <option>Select {{ $label }}</option>

        @foreach($options = Arr::isAssoc($options) ? $options : array_combine($options, $options) as $v => $l)
            <option value="{{ $v }}">{{ $l }}</option>
        @endforeach
    </select>

    <label for="{{ $model }}" class="form-label">
        {{ $label }}
    </label>

    @error($model)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
