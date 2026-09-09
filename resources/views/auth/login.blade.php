<x-guest-layout>
    <!-- Header coloré -->
    <div class="-mx-4 -mt-4 mb-6 px-6 py-5 rounded-t-xl" style="background: linear-gradient(135deg, #065A82, #1C7293);">
        <div class="flex items-center gap-3 mb-3">
            <div style="background: white; border-radius: 8px; padding: 4px 8px;">
                <span style="font-size: 12px; font-weight: 900; color: #065A82; font-family: Arial;">WMBI</span>
            </div>
            <div style="line-height: 1.1;">
                <div style="font-size: 12px; font-weight: 900; color: white; font-family: Arial;">Freelance</div>
                <div style="font-size: 12px; font-weight: 900; color: #02C39A; font-family: Arial;">Emploi</div>
            </div>
        </div>
        <h2 class="text-xl font-bold text-white">Connexion au compte</h2>
        <p class="text-blue-200 text-sm mt-1">Afin de postuler aux offres, veuillez entrer vos identifiants.</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">
                Adresse email
            </label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-indigo-500 transition bg-gray-50"
                placeholder="exemple@email.com">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Mot de passe -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">
                Mot de passe
            </label>
            <input id="password" type="password" name="password" required
                class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-indigo-500 transition bg-gray-50"
                placeholder="••••••••">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Se souvenir + mot de passe oublié -->
        <div class="flex items-center justify-between mb-6">
            <label class="flex items-center gap-2 text-sm text-gray-600">
                <input type="checkbox" name="remember" class="rounded border-gray-300 text-indigo-600">
                Se souvenir de moi
            </label>
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 hover:underline">
                    Mot de passe oublié ?
                </a>
            @endif
        </div>

        <!-- Bouton connexion -->
        <button type="submit"
            class="w-full py-3 rounded-lg font-bold text-white transition shadow-md"
            style="background: linear-gradient(135deg, #065A82, #1C7293);">
            CONNEXION
        </button>

        <!-- Séparateur -->
        <div class="flex items-center gap-3 my-5">
            <div class="flex-1 h-px bg-gray-200"></div>
            <span class="text-xs text-gray-400">OU</span>
            <div class="flex-1 h-px bg-gray-200"></div>
        </div>

        <!-- Lien inscription -->
        <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-600 font-semibold mb-2">Vous n'avez pas de compte ?</p>
            <a href="{{ route('register') }}"
                class="inline-block px-6 py-2 border-2 border-indigo-600 text-indigo-600 rounded-lg font-semibold hover:bg-indigo-600 hover:text-white transition text-sm">
                Créer un compte gratuitement
            </a>
        </div>

    </form>
</x-guest-layout>