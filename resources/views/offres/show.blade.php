<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Détail de l'offre
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg mb-6">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Détail offre -->
            <div class="bg-white shadow-sm rounded-xl p-8 mb-6">

                <div class="flex items-center justify-between mb-4">
                    <span class="text-xs bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full font-semibold">
                        {{ $offre->categorie->nom ?? 'Sans catégorie' }}
                    </span>
                    <span class="text-xs px-3 py-1 rounded-full font-semibold
                        {{ $offre->statut == 'ouverte' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ ucfirst($offre->statut) }}
                    </span>
                </div>

                <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $offre->titre }}</h1>

                <p class="text-gray-500 text-sm mb-6">
                    Publié par <strong>{{ $offre->client->name }}</strong>
                    · {{ $offre->created_at->diffForHumans() }}
                </p>

                <div class="bg-gray-50 rounded-lg p-4 mb-6 text-gray-700 leading-relaxed">
                    {!! nl2br(e($offre->description)) !!}
                </div>

                <div class="flex items-center gap-2">
                    <span class="text-gray-500 text-sm">Budget :</span>
                    <span class="text-green-600 font-bold text-lg">
                        {{ $offre->budget ? number_format($offre->budget, 0, ',', ' ') . ' FCFA' : 'À négocier' }}
                    </span>
                </div>
            </div>

            <!-- Formulaire postuler (freelance uniquement) -->
            @if(auth()->user()->isFreelance() && $offre->statut == 'ouverte')
            <div class="bg-white shadow-sm rounded-xl p-8 mb-6">

                <div class="mb-6 pb-4 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800">Postuler à cette offre</h3>
                    <p class="text-sm text-gray-500 mt-1">Présentez-vous et proposez votre tarif.</p>
                </div>

                <form method="POST" action="{{ route('candidatures.store') }}">
                    @csrf
                    <input type="hidden" name="offre_id" value="{{ $offre->id }}">

                    <!-- Message -->
                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">
                            Message de motivation <span class="text-red-500">*</span>
                        </label>
                        <textarea name="message" rows="5"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
                            placeholder="Présentez-vous, vos expériences et pourquoi vous êtes le bon profil pour cette mission...">{{ old('message') }}</textarea>
                        @error('message') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Tarif -->
                    <div class="mb-8">
                        <label class="block text-sm font-semibold text-gray-700 mb-1">
                            Tarif proposé <span class="text-gray-400 font-normal">— optionnel</span>
                        </label>
                        <div class="relative">
                            <input type="number" name="tarif_propose" value="{{ old('tarif_propose') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 transition pr-20"
                                placeholder="Ex: 120000">
                            <span class="absolute right-4 top-3.5 text-gray-400 text-sm font-medium">FCFA</span>
                        </div>
                        @error('tarif_propose') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-end pt-4 border-t border-gray-100">
                        <button type="submit"
                            class="px-8 py-3 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700 transition shadow-md">
                            Envoyer ma candidature
                        </button>
                    </div>
                </form>
            </div>
            @endif

            <!-- Actions client -->
            @if(auth()->user()->id == $offre->user_id)
            <div class="bg-white shadow-sm rounded-xl p-6 flex gap-3">
                <a href="{{ route('offres.edit', $offre) }}"
                    class="px-5 py-2.5 bg-yellow-500 text-white rounded-lg font-semibold hover:bg-yellow-600 transition">
                    Modifier
                </a>
                <form method="POST" action="{{ route('offres.destroy', $offre) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        onclick="return confirm('Supprimer cette offre ?')"
                        class="px-5 py-2.5 bg-red-500 text-white rounded-lg font-semibold hover:bg-red-600 transition">
                        Supprimer
                    </button>
                </form>
            </div>
            @endif

            <div class="mt-4">
                <a href="{{ route('offres.index') }}" class="text-indigo-600 hover:underline text-sm">
                    ← Retour aux offres
                </a>
            </div>

        </div>
    </div>
</x-app-layout>