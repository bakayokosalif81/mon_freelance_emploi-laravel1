<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FreelanceEmploi - Trouvez des missions freelance</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">

    {{-- NAVBAR --}}
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">

            <a href="/" style="display: flex; align-items: center; gap: 10px; text-decoration: none;">
    <div style="background: #065A82; border-radius: 10px; padding: 6px 10px;">
        <span style="font-size: 14px; font-weight: 900; color: white; font-family: Arial, sans-serif; letter-spacing: 1px;">WMBI</span>
    </div>
    <div style="line-height: 1.2;">
        <div style="font-size: 14px; font-weight: 900; color: #065A82; font-family: Arial, sans-serif;">Freelance</div>
        <div style="font-size: 14px; font-weight: 900; color: #02C39A; font-family: Arial, sans-serif;">Emploi</div>
    </div>
  </a>

            <div class="flex items-center gap-4">
                <a href="{{ route('offres.index') }}" class="text-gray-600 hover:text-indigo-600">Offres</a>
                @auth
                    <a href="{{ route('dashboard') }}"
                        class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                        Mon espace
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600 hover:text-indigo-600">Connexion</a>
                    <a href="{{ route('register') }}"
                        class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">
                        S'inscrire
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- HERO --}}
    <section class="bg-gradient-to-br from-indigo-600 to-purple-700 text-white py-24">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-5xl font-extrabold mb-6 leading-tight">
                Trouvez la mission freelance<br>qui vous correspond
            </h1>
            <p class="text-xl text-indigo-100 mb-10 max-w-2xl mx-auto">
                Des centaines d'offres publiées par des clients sérieux.
                Postulez en quelques clics et développez votre carrière.
            </p>
            <div class="flex justify-center gap-4">
                <a href="{{ route('offres.index') }}"
                    class="bg-white text-indigo-600 font-semibold px-8 py-3 rounded-lg hover:bg-indigo-50 transition">
                    🔍 Voir les offres
                </a>
                <a href="{{ route('register') }}"
                    class="border-2 border-white text-white font-semibold px-8 py-3 rounded-lg hover:bg-white hover:text-indigo-600 transition">
                    Créer un compte
                </a>
            </div>
        </div>
    </section>

    {{-- STATS --}}
    <section class="bg-white py-12 border-b">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div>
                    <p class="text-4xl font-bold text-indigo-600">
                        {{ \App\Models\Offre::where('statut', 'ouverte')->count() }}
                    </p>
                    <p class="text-gray-600 mt-1">Offres disponibles</p>
                </div>
                <div>
                    <p class="text-4xl font-bold text-indigo-600">
                        {{ \App\Models\User::where('role', 'freelance')->count() }}
                    </p>
                    <p class="text-gray-600 mt-1">Freelances inscrits</p>
                </div>
                <div>
                    <p class="text-4xl font-bold text-indigo-600">
                        {{ \App\Models\User::where('role', 'client')->count() }}
                    </p>
                    <p class="text-gray-600 mt-1">Clients actifs</p>
                </div>
            </div>
        </div>
    </section>

    {{-- DERNIÈRES OFFRES --}}
    <section class="py-16">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-gray-800 mb-8 text-center">
                🔥 Dernières offres publiées
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach(\App\Models\Offre::with(['client', 'categorie'])->where('statut', 'ouverte')->latest()->take(6)->get() as $offre)
                <div class="bg-white shadow-sm rounded-lg p-6 hover:shadow-md transition flex flex-col justify-between">
                    <div>
                        <span class="text-xs bg-indigo-100 text-indigo-700 px-2 py-1 rounded-full">
                            {{ $offre->categorie->nom ?? 'Sans catégorie' }}
                        </span>
                        <h3 class="text-lg font-semibold text-gray-800 mt-3">{{ $offre->titre }}</h3>
                        <p class="text-gray-500 text-sm mt-2">
                            {{ Str::limit($offre->description, 90) }}
                        </p>
                    </div>
                    <div class="mt-4 flex items-center justify-between">
                        <span class="text-green-600 font-semibold">
                            {{ $offre->budget ? number_format($offre->budget, 0, ',', ' ') . ' FCFA' : 'À négocier' }}
                        </span>
                        <a href="{{ route('offres.show', $offre) }}"
                            class="bg-indigo-600 text-white px-4 py-2 rounded-md text-sm hover:bg-indigo-700">
                            Voir l'offre
                        </a>
                    </div>
                    <p class="text-xs text-gray-400 mt-3">
                        Par {{ $offre->client->name }} · {{ $offre->created_at->diffForHumans() }}
                    </p>
                </div>
                @endforeach
            </div>

            <div class="text-center mt-10">
                <a href="{{ route('offres.index') }}"
                    class="bg-indigo-600 text-white px-8 py-3 rounded-lg hover:bg-indigo-700 transition">
                    Voir toutes les offres →
                </a>
            </div>
        </div>
    </section>

    {{-- COMMENT ÇA MARCHE --}}
    <section class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-gray-800 mb-12 text-center">
                🚀 Comment ça marche ?
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div class="p-6">
                    <div class="text-5xl mb-4">📝</div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">1. Créez un compte</h3>
                    <p class="text-gray-500">Inscrivez-vous en tant que freelance ou client en quelques secondes.</p>
                </div>
                <div class="p-6">
                    <div class="text-5xl mb-4">🔍</div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">2. Trouvez une mission</h3>
                    <p class="text-gray-500">Parcourez les offres disponibles et postulez à celles qui vous correspondent.</p>
                </div>
                <div class="p-6">
                    <div class="text-5xl mb-4">🤝</div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">3. Collaborez</h3>
                    <p class="text-gray-500">Le client accepte votre candidature et la mission démarre !</p>
                </div>
            </div>
        </div>
    </section>

    {{-- FOOTER --}}
    <footer class="bg-gray-800 text-gray-400 py-8 text-center">
        <p>© {{ date('Y') }} FreelanceEmploi — Tous droits réservés</p>
    </footer>

</body>
</html>