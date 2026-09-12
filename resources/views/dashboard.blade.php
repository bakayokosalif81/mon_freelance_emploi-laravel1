<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if(auth()->user()->isAdmin())
                Espace Administration
            @elseif(auth()->user()->isClient())
                Espace Client
            @else
                Espace Freelance
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            {{-- MESSAGE DE BIENVENUE --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-800">
                    Bonjour, {{ auth()->user()->name }}
                </h3>
                <p class="text-gray-600 mt-1">
                    @if(auth()->user()->isAdmin())
                        Vous êtes connecté en tant qu'<strong>Administrateur</strong>.
                    @elseif(auth()->user()->isClient())
                        Vous êtes connecté en tant que <strong>Client</strong>. Publiez des offres et trouvez des freelances.
                    @elseif(auth()->user()->isFreelance())
                        Vous êtes connecté en tant que <strong>Freelance</strong>. Parcourez les offres et postulez.
                    @endif
                </p>
            </div>

            {{-- ESPACE ADMIN --}}
            @if(auth()->user()->isAdmin())
            <div class="bg-white shadow-sm sm:rounded-lg p-6 text-center">
                <p class="text-gray-600 mb-4">Gérez les utilisateurs, les offres et les catégories.</p>
                <a href="{{ route('admin.dashboard') }}"
                    class="bg-red-600 text-white px-6 py-3 rounded-md hover:bg-red-700 text-lg font-semibold">
                    Accéder au panneau d'administration
                </a>
            </div>
            @endif

            {{-- ESPACE CLIENT --}}
            @if(auth()->user()->isClient())
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h4 class="font-semibold text-gray-700 mb-2">Mes offres publiées</h4>
                    <p class="text-4xl font-bold text-indigo-600">
                        {{ auth()->user()->offres()->count() }}
                    </p>
                    <div class="mt-4 flex gap-3">
                        <a href="{{ route('offres.create') }}"
                            class="inline-block bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                            + Publier une offre
                        </a>
                        <a href="{{ route('offres.index') }}"
                            class="inline-block bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300">
                            Voir mes offres
                        </a>
                    </div>
                </div>

                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h4 class="font-semibold text-gray-700 mb-2">Candidatures reçues</h4>
                    <p class="text-4xl font-bold text-green-600">
                        {{ \App\Models\Candidature::whereIn('offre_id', auth()->user()->offres()->pluck('id'))->count() }}
                    </p>
                    <a href="{{ route('candidatures.received') }}"
                        class="mt-4 inline-block bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                        Voir les candidatures
                    </a>
                </div>

            </div>
            @endif

            {{-- ESPACE FREELANCE --}}
            @if(auth()->user()->isFreelance())
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h4 class="font-semibold text-gray-700 mb-2">Offres disponibles</h4>
                    <p class="text-4xl font-bold text-indigo-600">
                        {{ \App\Models\Offre::where('statut', 'ouverte')->count() }}
                    </p>
                    <a href="{{ route('offres.index') }}"
                        class="mt-4 inline-block bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                        Parcourir les offres
                    </a>
                </div>

                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <h4 class="font-semibold text-gray-700 mb-2">Mes candidatures</h4>
                    <p class="text-4xl font-bold text-green-600">
                        {{ auth()->user()->candidatures()->count() }}
                    </p>
                    <a href="{{ route('candidatures.index') }}"
                        class="mt-4 inline-block bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                        Voir mes candidatures
                    </a>
                </div>

            </div>
            @endif

        </div>
    </div>
</x-app-layout>
