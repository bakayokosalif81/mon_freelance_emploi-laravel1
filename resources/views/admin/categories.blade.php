<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gestion des catégories
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                    {{ $errors->first() }}
                </div>
            @endif

            {{-- FORMULAIRE AJOUT --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="font-semibold text-gray-700 mb-4">Ajouter une catégorie</h3>
                <form method="POST" action="{{ route('admin.categories.store') }}">
                    @csrf
                    <div class="flex gap-3">
                        <input type="text" name="nom" value="{{ old('nom') }}"
                            class="flex-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500"
                            placeholder="Nom de la catégorie" required>
                        <button type="submit"
                            class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700">
                            Ajouter
                        </button>
                    </div>
                </form>
            </div>

            {{-- LISTE DES CATÉGORIES --}}
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-700 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-3">Nom</th>
                            <th class="px-6 py-3">Slug</th>
                            <th class="px-6 py-3">Nb offres</th>
                            <th class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($categories as $categorie)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-800">{{ $categorie->nom }}</td>
                            <td class="px-6 py-4 text-gray-500">{{ $categorie->slug }}</td>
                            <td class="px-6 py-4 text-indigo-600 font-semibold">{{ $categorie->offres_count }}</td>
                            <td class="px-6 py-4">
                                <form method="POST" action="{{ route('admin.categories.delete', $categorie) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Supprimer cette catégorie ?')"
                                        class="bg-red-500 text-white px-3 py-1 rounded text-xs hover:bg-red-600">
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="p-4">
                    {{ $categories->links() }}
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