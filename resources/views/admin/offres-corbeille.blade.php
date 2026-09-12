<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            🗑️ Corbeille des offres
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4">
                <a href="{{ route('admin.offres') }}" class="text-indigo-600 hover:underline text-sm">
                    ← Retour à la gestion des offres
                </a>
            </div>

            @if($offres->isEmpty())
                <div class="bg-white shadow-sm sm:rounded-lg p-6 text-center text-gray-500">
                    La corbeille est vide.
                </div>
            @else
                <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-gray-50 text-gray-700 uppercase text-xs">
                            <tr>
                                <th class="px-6 py-3">Titre</th>
                                <th class="px-6 py-3">Client</th>
                                <th class="px-6 py-3">Catégorie</th>
                                <th class="px-6 py-3">Supprimée le</th>
                                <th class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($offres as $offre)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-800">
                                    {{ Str::limit($offre->titre, 30) }}
                                </td>
                                <td class="px-6 py-4 text-gray-600">{{ $offre->client->name ?? '—' }}</td>
                                <td class="px-6 py-4 text-gray-600">{{ $offre->categorie->nom ?? '-' }}</td>
                                <td class="px-6 py-4 text-gray-500">{{ $offre->deleted_at->format('d/m/Y H:i') }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-2">
                                        <form method="POST" action="{{ route('admin.offres.restaurer', $offre->id) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="bg-green-500 text-white px-3 py-1 rounded text-xs hover:bg-green-600">
                                                ♻️ Restaurer
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.offres.forceDelete', $offre->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('⚠️ Suppression définitive et irréversible. Continuer ?')"
                                                class="bg-red-700 text-white px-3 py-1 rounded text-xs hover:bg-red-800">
                                                Supprimer définitivement
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
            @endif

        </div>
    </div>
</x-app-layout>
