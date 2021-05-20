@props([
    'color' => 'primary',
    'size' => null,
    'block' => false,
    'action' => null,
    'icon' => null,
    'label' => null,
])

@php
    $attributes = $attributes->class([
        'btn btn-' . $color,
        'btn-' . $size => $size,
        'w-100' => $block,
    ])->merge([
        'href' => '#',
        'wire:click.prevent' => $action,
    ]);
@endphp

<x-ui::link
    action="{!! $action !!}"
    icon="{!! $icon !!}"
    label="{!! $label !!}"
    {{ $attributes }}/>
