@props([
    'name',
    'style' => config('ui.font_awesome_style'),
])

@php
    $attributes = $attributes->class([
        'fa' . Str::limit($style, 1, null) . ' fa-' . $name,
    ])->merge([
        //
    ]);
@endphp

<i {{ $attributes }}></i>
