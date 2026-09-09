<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Tableau de bord Admin
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            {{-- STATS --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white shadow-sm sm:rounded-lg p-6 text-center">
                    <p class="text-4xl font-bold text-indigo-600">{{ $stats['users'] }}</p>
                    <p class="text-gray-500 mt-1">Utilisateurs total</p>
                </div>
                <div class="bg-white shadow-sm sm:rounded-lg p-6 text-center">
                    <p class="text-4xl font-bold text-green-600">{{ $stats['freelances'] }}</p>
                    <p class="text-gray-500 mt-1">Freelances</p>
                </div>
                <div class="bg-white shadow-sm sm:rounded-lg p-6 text-center">
                    <p class="text-4xl font-bold text-blue-600">{{ $stats['clients'] }}</p>
                    <p class="text-gray-500 mt-1">Clients</p>
                </div>
                <div class="bg-white shadow-sm sm:rounded-lg p-6 text-center">
                    <p class="text-4xl font-bold text-purple-600">{{ $stats['offres'] }}</p>
                    <p class="text-gray-500 mt-1">Offres total</p>
                </div>
                <div class="bg-white shadow-sm sm:rounded-lg p-6 text-center">
                    <p class="text-4xl font-bold text-yellow-600">{{ $stats['offres_ouvertes'] }}</p>
                    <p class="text-gray-500 mt-1">Offres ouvertes</p>
                </div>
                <div class="bg-white shadow-sm sm:rounded-lg p-6 text-center">
                    <p class="text-4xl font-bold text-red-600">{{ $stats['candidatures'] }}</p>
                    <p class="text-gray-500 mt-1">Candidatures</p>
                </div>
            </div>

            {{-- LIENS RAPIDES --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="{{ route('admin.users') }}"
                    class="bg-white shadow-sm sm:rounded-lg p-6 hover:shadow-md transition text-center">
                    <p class="text-2xl font-bold text-gray-800">Gérer les utilisateurs</p>
                    <p class="text-gray-500 mt-1 text-sm">Voir et supprimer les comptes</p>
                </a>
                <a href="{{ route('admin.offres') }}"
                    class="bg-white shadow-sm sm:rounded-lg p-6 hover:shadow-md transition text-center">
                    <p class="text-2xl font-bold text-gray-800">Gérer les offres</p>
                    <p class="text-gray-500 mt-1 text-sm">Voir et supprimer les offres</p>
                </a>
                <a href="{{ route('admin.categories') }}"
                    class="bg-white shadow-sm sm:rounded-lg p-6 hover:shadow-md transition text-center">
                    <p class="text-2xl font-bold text-gray-800">Gérer les catégories</p>
                    <p class="text-gray-500 mt-1 text-sm">Ajouter et supprimer des catégories</p>
                </a>
            </div>

        </div>
    </div>
</x-app-layout>