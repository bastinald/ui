@props([
    'options' => [],
    'data' => null,
    'lazy' => null,
    'defer' => null,
])

@php
    if ($lazy) $bind = '.lazy';
    else $bind = '.defer';

    $attributes = $attributes->class([
        'form-check-input',
        'is-invalid' => $errors->has($data),
    ])->merge([
        'type' => 'radio',
        'name' => $data,
        'wire:model' . $bind => 'data.' . $data,
    ]);
@endphp

<div class="mb-3">
    @foreach($options = Arr::isAssoc($options) ? $options : array_combine($options, $options) as $v => $l)
        <div class="form-check">
            <input id="{{ $data }}-{{ $loop->index }}" value="{{ $v }}" {{ $attributes }}>

            <label for="{{ $data }}-{{ $loop->index }}" class="form-check-label">
                {{ $l }}
            </label>

            @if($loop->last)
                @error($data)
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            @endif
        </div>
    @endforeach
</div>
