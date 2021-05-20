@props([
    'options' => [],
    'model' => null,
])

@php
    $attributes = $attributes->class([
        'form-check-input',
        'is-invalid' => $errors->has($model),
    ])->merge([
        'type' => 'radio',
        'name' => $model,
        'wire:model.defer' => 'data.' . $model,
    ]);
@endphp

<div class="mb-3">
    @foreach($options = Arr::isAssoc($options) ? $options : array_combine($options, $options) as $v => $l)
        <div class="form-check">
            <input id="{{ $model }}-{{ $loop->index }}" value="{{ $v }}" {{ $attributes }}>

            <label for="{{ $model }}-{{ $loop->index }}" class="form-check-label">
                {{ $l }}
            </label>

            @if($loop->last)
                @error($model)
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            @endif
        </div>
    @endforeach
</div>
