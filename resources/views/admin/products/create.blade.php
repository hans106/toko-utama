<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-teks leading-tight">
            Tambah Produk
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-lg mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <x-input-label for="category_id" value="Kategori" />
                        <select id="category_id" name="category_id" class="mt-1 block w-full border-latar rounded-md focus:border-brand focus:ring-brand" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="name" value="Nama Produk" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ old('name') }}" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="description" value="Deskripsi (opsional)" />
                        <textarea id="description" name="description" rows="3" class="mt-1 block w-full border-latar rounded-md focus:border-brand focus:ring-brand">{{ old('description') }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="image" value="Foto Produk (opsional)" />
                        <input id="image" name="image" type="file" accept="image/*" class="mt-1 block w-full">
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>

                    <div class="mb-4 flex items-center gap-2">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="rounded border-latar text-brand focus:border-brand focus:ring-brand">
                        <label for="is_active" class="text-teks">Tampilkan di website</label>
                    </div>

                    <div class="mb-4 flex items-center gap-2">
                        <input type="hidden" name="is_available" value="0">
                        <input type="checkbox" id="is_available" name="is_available" value="1" {{ old('is_available', true) ? 'checked' : '' }} class="rounded border-latar text-tersedia focus:border-tersedia focus:ring-tersedia">
                        <label for="is_available" class="text-teks">Sedang tersedia (bukan habis)</label>
                    </div>

                    <div class="flex items-center justify-end mt-4 space-x-3">
                        <a href="{{ route('admin.products.index') }}" class="text-teks/60 hover:text-teks">Batal</a>
                        <x-primary-button>Simpan</x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>