@props([
    'label',
    'click',
])

@php
    $attributes = $attributes->class([
        'dropdown-item',
    ])->merge([
        'type' => 'button',
        'wire:click' => $click,
    ]);
@endphp

<button {{ $attributes }}>
    {{ $label }}
</button>
