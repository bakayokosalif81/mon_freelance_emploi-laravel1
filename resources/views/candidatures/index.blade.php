<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📝 Mes candidatures
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if($candidatures->isEmpty())
                <div class="bg-white shadow-sm sm:rounded-lg p-6 text-center text-gray-500">
                    Vous n'avez pas encore postulé à une offre.
                    <a href="{{ route('offres.index') }}" class="text-indigo-600 hover:underline ml-1">
                        Parcourir les offres
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 gap-4">
                    @foreach($candidatures as $candidature)
                        <div class="bg-white shadow-sm sm:rounded-lg p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="font-semibold text-gray-800">
                                        {{ $candidature->offre->titre }}
                                    </h3>
                                    <p class="text-sm text-gray-500 mt-1">
                                        Client : {{ $candidature->offre->client->name }}
                                        · {{ $candidature->created_at->diffForHumans() }}
                                    </p>
                                    <p class="text-sm text-gray-600 mt-1">
                                        Tarif proposé :
                                        <strong>{{ $candidature->tarif_propose ? number_format($candidature->tarif_propose, 0, ',', ' ') . ' FCFA' : 'Non défini' }}</strong>
                                    </p>
                                </div>
                                <span class="px-3 py-1 rounded-full text-sm font-semibold
                                    {{ $candidature->statut == 'en_attente' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                    {{ $candidature->statut == 'acceptee' ? 'bg-green-100 text-green-700' : '' }}
                                    {{ $candidature->statut == 'refusee' ? 'bg-red-100 text-red-700' : '' }}">
                                    {{ ucfirst($candidature->statut) }}
                                </span>
                            </div>

                            @if($candidature->statut == 'acceptee')
                            <div class="mt-4 bg-green-50 border border-green-200 rounded-md p-4">
                                <p class="text-sm font-semibold text-green-800 mb-2">📞 Coordonnées du client</p>
                                <p class="text-sm text-gray-700">
                                    ✉️ Email :
                                    <a href="mailto:{{ $candidature->offre->client->email }}" class="text-indigo-600 hover:underline">
                                        {{ $candidature->offre->client->email }}
                                    </a>
                                </p>
                                @if($candidature->offre->client->telephone)
                                    <p class="text-sm text-gray-700">
                                        📱 Téléphone :
                                        <a href="tel:{{ $candidature->offre->client->telephone }}" class="text-indigo-600 hover:underline">
                                            {{ $candidature->offre->client->telephone }}
                                        </a>
                                    </p>
                                @else
                                    <p class="text-sm text-gray-400 italic">Le client n'a pas renseigné de numéro de téléphone.</p>
                                @endif
                            </div>
                            @endif

                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
