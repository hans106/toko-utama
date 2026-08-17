@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-latar focus:border-brand focus:ring-brand rounded-md shadow-sm']) }}>
