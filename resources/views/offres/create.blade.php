<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            Publier une offre
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm rounded-xl p-6">

                <div class="mb-4 pb-3 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800">Détails de l'offre</h3>
                    <p class="text-sm text-indigo-500 mt-1">Remplissez les informations ci-dessous pour publier votre offre.</p>
                </div>

                <form method="POST" action="{{ route('offres.store') }}">
                    @csrf

                    <!-- Titre + Catégorie sur la même ligne -->
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Titre de l'offre <span class="text-red-500">*</span></label>
                            <input type="text" name="titre" value="{{ old('titre') }}"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition text-sm"
                                placeholder="Ex: Développeur Laravel freelance" required>
                            @error('titre') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Catégorie <span class="text-red-500">*</span></label>
                            <select name="categorie_id"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition bg-white text-sm" required>
                                <option value="">-- Choisir une catégorie --</option>
                                @foreach($categories as $categorie)
                                    <option value="{{ $categorie->id }}" {{ old('categorie_id') == $categorie->id ? 'selected' : '' }}>
                                        {{ $categorie->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('categorie_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Description <span class="text-red-500">*</span></label>
                        <textarea name="description" rows="4"
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition text-sm"
                            placeholder="Décrivez la mission, les compétences requises, les délais..." required>{{ old('description') }}</textarea>
                        @error('description') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Budget -->
                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Budget <span class="text-gray-400 font-normal">— optionnel</span></label>
                        <div class="relative">
                            <input type="number" name="budget" value="{{ old('budget') }}"
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition text-sm pr-20"
                                placeholder="Ex: 150000">
                            <span class="absolute right-4 top-2.5 text-gray-400 text-sm font-medium">FCFA</span>
                        </div>
                        @error('budget') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                        <a href="{{ route('dashboard') }}"
                            class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-lg font-semibold hover:bg-gray-200 transition text-sm">
                            Annuler
                        </a>
                        <button type="submit"
                            class="px-8 py-2.5 text-white rounded-lg font-semibold transition shadow-md text-sm"
                            style="background: linear-gradient(135deg, #065A82, #1C7293);">
                            Publier l'offre
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>