@props([
    'color' => 'primary',
    'size' => null,
    'block' => false,
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
        'data-bs-toggle' => 'dropdown',
    ]);
@endphp

<div class="dropdown">
    <x-ui::link
        icon="{!! $icon !!}"
        label="{!! $label !!}"
        {{ $attributes }}/>
    <ul class="dropdown-menu dropdown-menu-end">
        {{ $slot }}
    </ul>
</div>
