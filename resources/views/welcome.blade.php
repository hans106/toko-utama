<x-public-layout>
    @php
        $setting = \App\Models\StoreSetting::first();
        $categories = \App\Models\Category::with(['products' => function ($q) {
            $q->where('is_active', true)->orderBy('name');
        }])->orderBy('name')->get();
        $waNumber = preg_replace('/[^0-9]/', '', $setting->whatsapp_number ?? '');
    @endphp

    <!-- Hero Section -->
    <section class="bg-white shadow-sm">
        <div class="max-w-6xl mx-auto px-4 py-12 text-center">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Toko Utama</h1>
            <p class="text-xl text-gray-600 mb-2">Grosir Rokok & Sembako</p>
            <p class="text-gray-500 mb-6">Karanganyar, Belakang Taman Pancasila</p>

            @if ($setting && $waNumber)
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 text-sm text-gray-600">
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ $setting->open_hours }}
                    </span>
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        {{ $setting->address }}
                    </span>
                </div>
            @endif

            <div class="mt-8">
                @if ($waNumber)
                    <a href="https://wa.me/{{ $waNumber }}" target="_blank" class="inline-flex items-center px-6 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                        </svg>
                        Hubungi Kami
                    </a>
                @endif
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="max-w-6xl mx-auto px-4 py-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-8 text-center">Produk Kami</h2>

        @foreach ($categories as $category)
            <div class="mb-12">
                <h3 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-2">{{ $category->name }}</h3>

                @if ($category->products->count() > 0)
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                        @foreach ($category->products as $product)
                            <div class="bg-white rounded-lg shadow-sm overflow-hidden {{ !$product->is_available ? 'opacity-75' : '' }}">
                                <div class="aspect-square bg-gray-100 relative">
                                    @if ($product->image_url)
                                        <img src="{{ Storage::url($product->image_url) }}" alt="{{ $product->name }}" class="w-full h-full object-cover {{ !$product->is_available ? 'grayscale' : '' }}">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-400 text-xs">No image</div>
                                    @endif

                                    @if (!$product->is_available)
                                        <span class="absolute top-2 right-2 px-2 py-1 text-xs font-semibold bg-yellow-500 text-white rounded">Habis</span>
                                    @endif
                                </div>

                                <div class="p-3">
                                    <h4 class="font-medium text-gray-900 text-sm truncate">{{ $product->name }}</h4>
                                    @if ($product->description)
                                        <p class="text-xs text-gray-500 mt-1" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">{{ $product->description }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-sm">Belum ada produk di kategori ini.</p>
                @endif
            </div>
        @endforeach

        @if ($categories->count() == 0)
            <p class="text-center text-gray-500">Belum ada kategori produk.</p>
        @endif
    </section>

    <!-- CTA Section -->
    <section class="bg-green-600 text-white py-12">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-2xl font-bold mb-4">Tertarik dengan produk kami?</h2>
            <p class="mb-6 text-green-100">Hubungi kami via WhatsApp untuk informasi lebih lanjut.</p>
            @if ($waNumber)
                <a href="https://wa.me/{{ $waNumber }}" target="_blank" class="inline-flex items-center px-8 py-3 bg-white text-green-600 font-semibold rounded-lg hover:bg-gray-100 transition">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    Chat WhatsApp
                </a>
            @endif
        </div>
    </section>
</x-public-layout>