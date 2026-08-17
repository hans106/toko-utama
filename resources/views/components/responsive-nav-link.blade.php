@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-brand text-start text-base font-medium text-brand-dark bg-latar focus:outline-none focus:text-brand-dark focus:bg-latar/80 focus:border-brand-dark transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-teks/70 hover:text-teks hover:bg-latar hover:border-latar focus:outline-none focus:text-teks focus:bg-latar focus:border-latar transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
