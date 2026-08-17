<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-teks leading-tight">
            Edit Kategori
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-lg mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('admin.categories.update', $category) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <x-input-label for="name" value="Nama Kategori" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" value="{{ old('name', $category->name) }}" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4 space-x-3">
                        <a href="{{ route('admin.categories.index') }}" class="text-teks/60 hover:text-teks">Batal</a>
                        <x-primary-button>Update</x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>