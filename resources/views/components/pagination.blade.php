@props([
    'links',
    'count' => false,
    'justify' => null,
])

@php
    $justify = $justify ?? ($count ? 'between' : 'end');

    $attributes = $attributes->class([
        'row align-items-center justify-content-' . $justify,
    ])->merge([
        //
    ]);
@endphp

<div {{ $attributes }}>
    @if($links->count() && $count)
        <div class="col-auto text-muted">
            {{ $links->firstItem() }} {{ __('-') }} {{ $links->lastItem() }}
            {{ __('of') }} {{ $links->total() }}
        </div>
    @endif

    <div class="col-auto mb-n3">
        <div class="d-block d-lg-none">
            {{ $links->links('livewire::simple-bootstrap') }}
        </div>

        <div class="d-none d-lg-block">
            {{ $links->links('livewire::bootstrap') }}
        </div>
    </div>
</div>
