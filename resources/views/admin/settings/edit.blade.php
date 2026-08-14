<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Setting Store
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-lg mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.store-settings.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <x-input-label for="address" value="Alamat Toko" />
                        <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" value="{{ old('address', $setting->address) }}" required />
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="open_hours" value="Jam Buka" />
                        <x-text-input id="open_hours" name="open_hours" type="text" class="mt-1 block w-full" value="{{ old('open_hours', $setting->open_hours) }}" placeholder="contoh: 07.00 - 21.00" required />
                        <x-input-error :messages="$errors->get('open_hours')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <x-input-label for="whatsapp_number" value="Nomor WhatsApp" />
                        <x-text-input id="whatsapp_number" name="whatsapp_number" type="text" class="mt-1 block w-full" value="{{ old('whatsapp_number', $setting->whatsapp_number) }}" placeholder="contoh: " required />
                        <x-input-error :messages="$errors->get('whatsapp_number')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button>Save</x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>