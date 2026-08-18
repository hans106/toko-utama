<x-public-layout>
    @php
        $setting = \App\Models\StoreSetting::first();
        $categories = \App\Models\Category::with([
            'products' => function ($q) {
                $q->where('is_active', true)->orderBy('name');
            },
        ])
            ->orderBy('name')
            ->get();
        // Rokok ditonjolin sebagai identitas utama toko
        $categories = $categories->sortBy(fn($c) => str_contains(strtolower($c->name), 'rokok') ? 0 : 1)->values();
        $waNumber = preg_replace('/[^0-9]/', '', $setting->whatsapp_number ?? '');
    @endphp

    <!-- Hero Section -->
    <section class="bg-brand relative overflow-hidden">
        <img src="{{ asset('images/utama-shop-icon.png') }}" alt="" class="absolute -top-4 -right-4 w-48 h-48 object-contain opacity-10 pointer-events-none">

        <div class="max-w-4xl mx-auto px-4 py-16 text-center">
            <p class="font-body text-xs font-bold tracking-[0.2em] text-cream mb-3">UTAMA SHOP &middot; KARANGANYAR
            </p>
            <h1 class="font-display font-extrabold text-4xl sm:text-5xl text-white leading-tight mb-3">Grosir Rokok &amp; Sembako
            </h1>
            <p class="font-display font-semibold text-base sm:text-lg text-cream/80 tracking-wide mb-8">Murah Tenan</p>

            @if ($setting)
                <div
                    class="flex flex-col sm:flex-row items-center justify-center gap-3 sm:gap-6 text-sm text-cream/90 mb-6">
                    @if ($setting->open_hours)
                        <span class="inline-flex items-center gap-2">
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $setting->open_hours }}
                        </span>
                    @endif
                    @if ($setting->address)
                        <span class="inline-flex items-center gap-2">
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            {{ $setting->address }}
                        </span>
                    @endif
                </div>
            @endif

            @if ($waNumber)
                <a href="https://wa.me/{{ $waNumber }}" target="_blank"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-teks text-white font-body font-bold text-sm rounded-full hover:bg-teks/90 transition">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                    </svg>
                    Chat via WhatsApp
                </a>
            @endif
        </div>
    </section>

    <!-- Products Section -->
    <section class="max-w-6xl mx-auto px-4 py-14">
        @foreach ($categories as $category)
            <div class="mb-12 last:mb-0">
                <div class="flex items-center gap-3 mb-5">
                    <span class="w-2 h-2 rounded-full bg-brand shrink-0"></span>
                    <h2 class="font-display font-bold text-lg text-ink">{{ $category->name }}</h2>
                </div>

                @if ($category->products->count() > 0)
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                        @foreach ($category->products as $product)
                            <div class="bg-white rounded-xl border border-latar overflow-hidden">
                                <div class="aspect-[4/3] bg-latar relative">
                                    @if ($product->image_url)
                                        <img src="{{ Storage::url($product->image_url) }}" alt="{{ $product->name }}"
                                            class="w-full h-full object-cover {{ !$product->is_available ? 'grayscale' : '' }}">
                                    @else
                                        <div
                                            class="w-full h-full flex items-center justify-center text-ink-soft text-xs">
                                            No image</div>
                                    @endif

                                    @if (!$product->is_available)
                                        <span
                                            class="absolute top-2 -right-1 px-3 py-0.5 font-display text-[11px] font-extrabold bg-ink text-white rounded-sm -rotate-3 shadow-sm">HABIS</span>
                                    @endif
                                </div>

                                <div class="p-3">
                                    <h3 class="font-body font-medium text-ink text-sm truncate">{{ $product->name }}
                                    </h3>
                                    @if ($product->description)
                                        <p class="font-body text-xs text-ink-soft mt-1"
                                            style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                            {{ $product->description }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="font-body text-ink-soft text-sm">Belum ada produk di kategori ini.</p>
                @endif
            </div>
        @endforeach

        @if ($categories->count() == 0)
            <p class="font-body text-center text-ink-soft">Belum ada kategori produk.</p>
        @endif
    </section>

    <!-- CTA Section -->
    <section class="bg-ink text-white py-14">
        <div class="max-w-2xl mx-auto px-4 text-center">
            <h2 class="font-display font-bold text-2xl mb-3">Contact Us</h2>
            <p class="font-body text-cream/70 mb-6 text-sm">Chat langsung, kami akan bantu siapkan pesanan Anda</p>
            @if ($waNumber)
                <a href="https://wa.me/{{ $waNumber }}" target="_blank"
                    class="inline-flex items-center gap-2 px-7 py-3 bg-brand text-white font-body font-bold text-sm rounded-full hover:bg-brand-dark transition">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                    </svg>
                     Chat Sekarang
                </a>
            @endif
        </div>
    </section>

    @if ($waNumber)
        <a href="https://wa.me/{{ $waNumber }}" target="_blank"
            class="fixed bottom-4 right-4 sm:hidden flex items-center justify-center w-14 h-14 rounded-full bg-[#25D366] text-white shadow-lg hover:bg-[#20bd5a] transition z-50">
            <svg class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
                <path
                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
            </svg>
        </a>
    @endif
</x-public-layout>
