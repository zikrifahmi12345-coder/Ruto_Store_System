@props(['label'])

<div {{ $attributes->merge(['class' => 'ruto-nav-group']) }}>
    <p class="ruto-nav-group-label">{{ $label }}</p>
    <div class="ruto-nav-group-items">
        {{ $slot }}
    </div>
</div>
