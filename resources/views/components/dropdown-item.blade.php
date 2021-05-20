@props([
    'action' => null,
    'icon' => null,
    'label' => null,
])

@php
    $attributes = $attributes->class([
        'dropdown-item',
        'active' => Request::url() == $attributes->get('href'),
    ])->merge([
        'href' => '#',
        'wire:click.prevent' => $action,
    ]);
@endphp

<li>
    <x-ui::link
        action="{!! $action !!}"
        icon="{!! $icon !!}"
        label="{!! $label !!}"
        {{ $attributes }}/>
</li>
