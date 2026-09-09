<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            📩 Candidatures reçues
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
                    Aucune candidature reçue pour le moment.
                </div>
            @else
                <div class="grid grid-cols-1 gap-4">
                    @foreach($candidatures as $candidature)
                        <div class="bg-white shadow-sm sm:rounded-lg p-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="font-semibold text-gray-800">
                                        {{ $candidature->freelance->name }}
                                    </h3>
                                    <p class="text-sm text-gray-500 mt-1">
                                        Offre : <strong>{{ $candidature->offre->titre }}</strong>
                                        · {{ $candidature->created_at->diffForHumans() }}
                                    </p>
                                    <p class="text-sm text-gray-600 mt-1">
                                        Tarif proposé :
                                        <strong>{{ $candidature->tarif_propose ? number_format($candidature->tarif_propose, 0, ',', ' ') . ' FCFA' : 'Non défini' }}</strong>
                                    </p>
                                    <p class="text-gray-600 mt-2 text-sm">
                                        {{ $candidature->message }}
                                    </p>
                                </div>
                                <span class="px-3 py-1 rounded-full text-sm font-semibold
                                    {{ $candidature->statut == 'en_attente' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                    {{ $candidature->statut == 'acceptee' ? 'bg-green-100 text-green-700' : '' }}
                                    {{ $candidature->statut == 'refusee' ? 'bg-red-100 text-red-700' : '' }}">
                                    {{ ucfirst($candidature->statut) }}
                                </span>
                            </div>

                            @if($candidature->statut == 'en_attente')
                            <div class="mt-4 flex gap-3">
                                <form method="POST" action="{{ route('candidatures.updateStatut', $candidature) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="statut" value="acceptee">
                                    <button type="submit"
                                        class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 text-sm">
                                        ✅ Accepter
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('candidatures.updateStatut', $candidature) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="statut" value="refusee">
                                    <button type="submit"
                                        class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 text-sm">
                                        ❌ Refuser
                                    </button>
                                </form>
                            </div>
                            @endif

                        </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>