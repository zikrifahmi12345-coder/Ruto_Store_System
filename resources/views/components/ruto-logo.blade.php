@props([
    'class' => 'w-40 h-40',
    'alt' => 'RUTO Coffee Shop',
])

@php
    $extensions = ['png', 'svg', 'jpg', 'jpeg', 'webp'];
    $logoUrl = asset('images/ruto-logo-fallback.svg');

    foreach ($extensions as $ext) {
        if (file_exists(public_path("images/ruto-logo.{$ext}"))) {
            $logoUrl = asset("images/ruto-logo.{$ext}");
            break;
        }
    }
@endphp

<img
    src="{{ $logoUrl }}"
    alt="{{ $alt }}"
    {{ $attributes->merge(['class' => $class]) }}
    onerror="this.onerror=null; this.src='{{ asset('images/ruto-logo-fallback.svg') }}';"
/>
