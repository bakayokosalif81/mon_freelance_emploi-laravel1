<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            👤 Mon Profil
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <div class="flex items-center gap-6 mb-6">
                    {{-- Photo de profil --}}
                    @if($user->photo)
                        <img src="{{ Storage::url($user->photo) }}"
                            class="w-24 h-24 rounded-full object-cover border-4 border-indigo-200">
                    @else
                        <div class="w-24 h-24 rounded-full bg-indigo-100 flex items-center justify-center text-4xl">
                            👤
                        </div>
                    @endif

                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h2>
                        <p class="text-gray-500">{{ $user->email }}</p>
                        <span class="text-xs px-2 py-1 rounded-full mt-1 inline-block
                            {{ $user->role == 'freelance' ? 'bg-indigo-100 text-indigo-700' : 'bg-green-100 text-green-700' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>
                </div>

                {{-- Bio --}}
                <div class="mb-4">
                    <h3 class="font-semibold text-gray-700 mb-1">📝 Bio</h3>
                    <p class="text-gray-600">
                        {{ $user->bio ?? 'Aucune bio renseignée.' }}
                    </p>
                </div>

                {{-- Compétences --}}
                @if($user->isFreelance())
                <div class="mb-4">
                    <h3 class="font-semibold text-gray-700 mb-2">🛠️ Compétences</h3>
                    @if($user->competences)
                        <div class="flex flex-wrap gap-2">
                            @foreach(explode(',', $user->competences) as $competence)
                                <span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-sm">
                                    {{ trim($competence) }}
                                </span>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">Aucune compétence renseignée.</p>
                    @endif
                </div>
                @endif

                {{-- Stats --}}
                @if($user->isFreelance())
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div class="bg-gray-50 rounded-lg p-4 text-center">
                        <p class="text-3xl font-bold text-indigo-600">{{ $user->candidatures()->count() }}</p>
                        <p class="text-gray-500 text-sm">Candidatures envoyées</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 text-center">
                        <p class="text-3xl font-bold text-green-600">
                            {{ $user->candidatures()->where('statut', 'acceptee')->count() }}
                        </p>
                        <p class="text-gray-500 text-sm">Missions acceptées</p>
                    </div>
                </div>
                @endif

                @if($user->isClient())
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div class="bg-gray-50 rounded-lg p-4 text-center">
                        <p class="text-3xl font-bold text-indigo-600">{{ $user->offres()->count() }}</p>
                        <p class="text-gray-500 text-sm">Offres publiées</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 text-center">
                        <p class="text-3xl font-bold text-green-600">
                            {{ \App\Models\Candidature::whereIn('offre_id', $user->offres()->pluck('id'))->count() }}
                        </p>
                        <p class="text-gray-500 text-sm">Candidatures reçues</p>
                    </div>
                </div>
                @endif

                <a href="{{ route('profil.edit') }}"
                    class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700">
                    ✏️ Modifier mon profil
                </a>

            </div>
        </div>
    </div>
</x-app-layout>