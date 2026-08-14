<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kelola Produk
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium">Daftar Produk</h3>
                    <a href="{{ route('admin.products.create') }}" class="px-4 py-2 bg-gray-800 text-white rounded hover:bg-gray-700">
                        + Tambah Produk
                    </a>
                </div>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">Foto</th>
                            <th class="py-2">Nama</th>
                            <th class="py-2">Kategori</th>
                            <th class="py-2">Status</th>
                            <th class="py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr class="border-b">
                                <td class="py-2">
                                    @if ($product->image_url)
                                        <img src="{{ Storage::url($product->image_url) }}" class="w-12 h-12 object-cover rounded {{ !$product->is_available ? 'grayscale' : '' }}">
                                    @else
                                        <div class="w-12 h-12 bg-gray-200 rounded flex items-center justify-center text-xs text-gray-400">No image</div>
                                    @endif
                                </td>
                                <td class="py-2">{{ $product->name }}</td>
                                <td class="py-2">{{ $product->category->name }}</td>
                                <td class="py-2 space-x-1">
                                    @if (!$product->is_active)
                                        <span class="px-2 py-1 text-xs bg-gray-200 text-gray-700 rounded">Nonaktif</span>
                                    @elseif (!$product->is_available)
                                        <span class="px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded">Habis</span>
                                    @else
                                        <span class="px-2 py-1 text-xs bg-green-100 text-green-800 rounded">Tersedia</span>
                                    @endif
                                </td>
                                <td class="py-2 space-x-2">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-600 hover:underline">Edit</a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('Yakin mau hapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-4 text-center text-gray-500">Belum ada produk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>