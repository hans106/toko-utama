<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-teks border border-transparent rounded-md font-semibold text-xs text-cream uppercase tracking-widest hover:bg-teks/90 focus:bg-teks/90 active:bg-teks focus:outline-none focus:ring-2 focus:ring-brand focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
