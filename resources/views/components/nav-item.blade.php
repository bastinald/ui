@props([
    'action' => null,
    'icon' => null,
    'label' => null,
])

@php
    $attributes = $attributes->class([
        'nav-link',
        'active' => Request::url() == $attributes->get('href'),
    ])->merge([
        'href' => '#',
        'wire:click.prevent' => $action,
    ]);
@endphp

<li class="nav-item">
    <x-ui::link
        action="{!! $action !!}"
        icon="{!! $icon !!}"
        label="{!! $label !!}"
        {{ $attributes }}/>
</li>
