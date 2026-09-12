<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Offres disponibles
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            {{-- BARRE DE RECHERCHE ET FILTRES --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6 mb-6">
                <form method="GET" action="{{ route('offres.index') }}">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                        <div>
                            <label class="block text-gray-700 font-semibold mb-1 text-sm">Mot-clé</label>
                            <input type="text" name="search" value="{{ request('search') }}"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 text-sm"
                                placeholder="Titre ou description...">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-1 text-sm">Catégorie</label>
                            <select name="categorie"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 text-sm">
                                <option value="">-- Toutes les catégories --</option>
                                @foreach($categories as $categorie)
                                    <option value="{{ $categorie->id }}"
                                        {{ request('categorie') == $categorie->id ? 'selected' : '' }}>
                                        {{ $categorie->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-gray-700 font-semibold mb-1 text-sm">Budget max (FCFA)</label>
                            <input type="number" name="budget_max" value="{{ request('budget_max') }}"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 text-sm"
                                placeholder="Ex: 500000">
                        </div>

                    </div>

                    <div class="mt-4 flex gap-3">
                        <button type="submit"
                            class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700 text-sm">
                            Rechercher
                        </button>
                        <a href="{{ route('offres.index') }}"
                            class="bg-gray-200 text-gray-700 px-6 py-2 rounded-md hover:bg-gray-300 text-sm">
                            Réinitialiser
                        </a>
                    </div>
                </form>
            </div>

            {{-- RÉSULTATS --}}
            @if($offres->isEmpty())
                <div class="bg-white shadow-sm sm:rounded-lg p-6 text-center text-gray-500">
                    Aucune offre ne correspond à votre recherche.
                </div>
            @else
                <p class="text-gray-500 text-sm mb-4">
                    {{ $offres->total() }} offre(s) trouvée(s)
                </p>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($offres as $offre)
                        <div class="bg-white shadow-sm sm:rounded-lg p-6 flex flex-col justify-between
                            {{ $offre->en_vedette ? 'ring-2 ring-amber-400' : '' }}">
                            <div>
                                <div class="flex items-center gap-2 flex-wrap">
                                    <span class="text-xs bg-indigo-100 text-indigo-700 px-2 py-1 rounded-full">
                                        {{ $offre->categorie->nom ?? 'Sans catégorie' }}
                                    </span>
                                    @if($offre->en_vedette)
                                        <span class="text-xs bg-amber-100 text-amber-800 px-2 py-1 rounded-full font-semibold">
                                            🔥 En vedette
                                        </span>
                                    @endif
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800 mt-2">
                                    {{ $offre->titre }}
                                </h3>
                                <p class="text-gray-600 text-sm mt-2">
                                    {{ Str::limit($offre->description, 100) }}
                                </p>
                            </div>
                            <div class="mt-4 flex items-center justify-between">
                                <span class="text-green-600 font-semibold">
                                    {{ $offre->budget ? number_format($offre->budget, 0, ',', ' ') . ' FCFA' : 'Budget non défini' }}
                                </span>
                                <a href="{{ route('offres.show', $offre) }}"
                                    class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm hover:bg-indigo-700">
                                    Voir l'offre
                                </a>
                            </div>
                            <div class="mt-3 text-xs text-gray-400">
                                Publié par {{ $offre->client->name }} · {{ $offre->created_at->diffForHumans() }}
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $offres->links() }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
