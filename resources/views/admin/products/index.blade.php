<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-teks leading-tight">
            Kelola Produk
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-tersedia/10 text-tersedia rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-teks">Daftar Produk</h3>
                    <a href="{{ route('admin.products.create') }}" class="px-4 py-2 bg-brand text-white rounded hover:bg-brand-dark">
                        + Tambah Produk
                    </a>
                </div>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-latar">
                            <th class="py-2 text-teks/80">Foto</th>
                            <th class="py-2 text-teks/80">Nama</th>
                            <th class="py-2 text-teks/80">Kategori</th>
                            <th class="py-2 text-teks/80">Status</th>
                            <th class="py-2 text-teks/80">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr class="border-b border-latar/60">
                                <td class="py-2">
                                    @if ($product->image_url)
                                        <img src="{{ Storage::url($product->image_url) }}" class="w-12 h-12 object-cover rounded {{ !$product->is_available ? 'grayscale' : '' }}">
                                    @else
                                        <div class="w-12 h-12 bg-latar rounded flex items-center justify-center text-xs text-teks/40">No image</div>
                                    @endif
                                </td>
                                <td class="py-2 text-teks">{{ $product->name }}</td>
                                <td class="py-2 text-teks">{{ $product->category->name }}</td>
                                <td class="py-2 space-x-1">
                                    @if (!$product->is_active)
                                        <span class="px-2 py-1 text-xs bg-latar text-teks/70 rounded">Nonaktif</span>
                                    @elseif (!$product->is_available)
                                        <span class="px-2 py-1 text-xs bg-brand/10 text-brand rounded">Habis</span>
                                    @else
                                        <span class="px-2 py-1 text-xs bg-tersedia/10 text-tersedia rounded">Tersedia</span>
                                    @endif
                                </td>
                                <td class="py-2 space-x-2">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="text-brand hover:text-brand-dark">Edit</a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('Yakin mau hapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-4 text-center text-teks/50">Belum ada produk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>