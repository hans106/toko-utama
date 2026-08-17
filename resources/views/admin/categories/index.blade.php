<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-teks leading-tight">
            Kelola Kategori
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
                    <h3 class="text-lg font-medium text-teks">Daftar Kategori</h3>
                    <a href="{{ route('admin.categories.create') }}" class="px-4 py-2 bg-brand text-white rounded hover:bg-brand-dark">
                        + Tambah Kategori
                    </a>
                </div>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-latar">
                            <th class="py-2 text-teks/80">Nama Kategori</th>
                            <th class="py-2 text-teks/80">Jumlah Produk</th>
                            <th class="py-2 text-teks/80">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr class="border-b border-latar/60">
                                <td class="py-2 text-teks">{{ $category->name }}</td>
                                <td class="py-2 text-teks">{{ $category->products_count }}</td>
                                <td class="py-2 space-x-2">
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="text-brand hover:text-brand-dark">Edit</a>
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline" onsubmit="return confirm('Yakin mau hapus kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="py-4 text-center text-teks/50">Belum ada kategori.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>