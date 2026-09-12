<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ✏️ Modifier mon profil
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('profil.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    {{-- Photo --}}
                    <div class="mb-6 text-center">
                        @if($user->photo)
                            <img src="{{ Storage::url($user->photo) }}"
                                class="w-24 h-24 rounded-full object-cover border-4 border-indigo-200 mx-auto mb-3">
                        @else
                            <div class="w-24 h-24 rounded-full bg-indigo-100 flex items-center justify-center text-4xl mx-auto mb-3">
                                👤
                            </div>
                        @endif
                        <label class="block text-gray-700 font-semibold mb-1">📸 Photo de profil</label>
                        <input type="file" name="photo" accept="image/*"
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                            file:rounded-md file:border-0 file:bg-indigo-50 file:text-indigo-700
                            hover:file:bg-indigo-100">
                        @error('photo') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Nom --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-1">Nom complet</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500" required>
                        @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Bio --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-1">📝 Bio</label>
                        <textarea name="bio" rows="4"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500"
                            placeholder="Parlez de vous, votre expérience...">{{ old('bio', $user->bio) }}</textarea>
                        @error('bio') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Téléphone --}}
                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-1">📞 Téléphone</label>
                        <input type="text" name="telephone" value="{{ old('telephone', $user->telephone) }}"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500"
                            placeholder="Ex: +225 07 00 00 00 00">
                        @error('telephone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>

                    {{-- Compétences (freelance uniquement) --}}
                    @if($user->isFreelance())
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-1">🛠️ Compétences</label>
                        <input type="text" name="competences" value="{{ old('competences', $user->competences) }}"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500"
                            placeholder="Ex: Laravel, Vue.js, MySQL (séparés par des virgules)">
                        <p class="text-xs text-gray-400 mt-1">Séparez les compétences par des virgules</p>
                        @error('competences') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                    @endif

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('profil.show') }}"
                            class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">
                            Annuler
                        </a>
                        <button type="submit"
                            class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700">
                            Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
