@props([
    'icon',
    'title',
    'click',
])

@php
    $attributes = $attributes->class([
        'btn btn-link px-1 py-0',
    ])->merge([
        'type' => 'button',
        'title' => $title,
        'wire:click' => $click,
    ]);
@endphp

<button {{ $attributes }}>
    <x-ui::icon :name="$icon"/>
</button>
