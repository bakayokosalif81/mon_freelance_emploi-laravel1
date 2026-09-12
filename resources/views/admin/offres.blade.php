<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gestion des offres
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4 flex justify-end">
                <a href="{{ route('admin.offres.corbeille') }}"
                    class="bg-gray-700 text-white px-4 py-2 rounded-md text-sm hover:bg-gray-800">
                    🗑️ Voir la corbeille
                </a>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-700 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-3">Titre</th>
                            <th class="px-6 py-3">Client</th>
                            <th class="px-6 py-3">Catégorie</th>
                            <th class="px-6 py-3">Budget</th>
                            <th class="px-6 py-3">Statut</th>
                            <th class="px-6 py-3">Vedette</th>
                            <th class="px-6 py-3">Date</th>
                            <th class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($offres as $offre)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-800">
                                {{ Str::limit($offre->titre, 30) }}
                            </td>
                            <td class="px-6 py-4 text-gray-600">{{ $offre->client->name }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $offre->categorie->nom ?? '-' }}</td>
                            <td class="px-6 py-4 text-green-600 font-semibold">
                                {{ $offre->budget ? number_format($offre->budget, 0, ',', ' ') . ' FCFA' : '-' }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold
                                    {{ $offre->statut == 'ouverte' ? 'bg-green-100 text-green-700' : '' }}
                                    {{ $offre->statut == 'fermee' ? 'bg-red-100 text-red-700' : '' }}
                                    {{ $offre->statut == 'en_cours' ? 'bg-yellow-100 text-yellow-700' : '' }}">
                                    {{ ucfirst($offre->statut) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @if($offre->vedette_statut == 'active')
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-800">
                                        🔥 Active
                                    </span>
                                @elseif($offre->vedette_statut == 'en_attente')
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold bg-orange-100 text-orange-700">
                                        ⏳ En attente paiement
                                    </span>
                                @else
                                    <span class="text-xs text-gray-400">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-500">{{ $offre->created_at->format('d/m/Y') }}</td>
                            <td class="px-6 py-4">
                                <div class="flex flex-col gap-2">
                                    @if($offre->vedette_statut == 'en_attente' || $offre->vedette_statut == 'aucune')
                                        <form method="POST" action="{{ route('admin.offres.vedette.activer', $offre) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="bg-amber-500 text-white px-3 py-1 rounded text-xs hover:bg-amber-600 w-full">
                                                Activer vedette
                                            </button>
                                        </form>
                                    @endif
                                    @if($offre->vedette_statut == 'active')
                                        <form method="POST" action="{{ route('admin.offres.vedette.desactiver', $offre) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="bg-gray-400 text-white px-3 py-1 rounded text-xs hover:bg-gray-500 w-full">
                                                Désactiver
                                            </button>
                                        </form>
                                    @endif
                                    <form method="POST" action="{{ route('admin.offres.delete', $offre) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Déplacer cette offre dans la corbeille ?')"
                                            class="bg-red-500 text-white px-3 py-1 rounded text-xs hover:bg-red-600 w-full">
                                            Supprimer
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="p-4">
                    {{ $offres->links() }}
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('admin.dashboard') }}" class="text-indigo-600 hover:underline">
                    Retour au dashboard admin
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
