<x-guest-layout>
    <!-- Header coloré -->
    <div class="-mx-4 -mt-4 mb-6 px-6 py-4 rounded-t-xl" style="background: linear-gradient(135deg, #065A82, #1C7293);">
        <div class="flex items-center gap-3 mb-2">
            <div style="background: white; border-radius: 8px; padding: 4px 8px;">
                <span style="font-size: 12px; font-weight: 900; color: #065A82; font-family: Arial;">WMBI</span>
            </div>
            <div style="line-height: 1.1;">
                <div style="font-size: 12px; font-weight: 900; color: white; font-family: Arial;">Freelance</div>
                <div style="font-size: 12px; font-weight: 900; color: #02C39A; font-family: Arial;">Emploi</div>
            </div>
        </div>
        <h2 class="text-lg font-bold text-white">Créer un compte</h2>
        <p class="text-blue-200 text-xs mt-1">Rejoignez la plateforme FreelanceEmploi gratuitement.</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nom + Rôle sur la même ligne -->
        <div class="grid grid-cols-2 gap-3 mb-3">
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Nom complet</label>
                <input type="text" name="name" value="{{ old('name') }}" required autofocus
                    class="w-full px-3 py-2 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-indigo-500 transition bg-gray-50 text-sm"
                    placeholder="Jean Dupont">
                <x-input-error :messages="$errors->get('name')" class="mt-1" />
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Je suis un...</label>
                <select name="role"
                    class="w-full px-3 py-2 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-indigo-500 transition bg-gray-50 text-sm">
                    <option value="freelance" {{ old('role') == 'freelance' ? 'selected' : '' }}>Freelance</option>
                    <option value="client" {{ old('role') == 'client' ? 'selected' : '' }}>Client</option>
                </select>
                <x-input-error :messages="$errors->get('role')" class="mt-1" />
            </div>
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label class="block text-xs font-semibold text-gray-700 mb-1">Adresse email</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                class="w-full px-3 py-2 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-indigo-500 transition bg-gray-50 text-sm"
                placeholder="exemple@email.com">
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Mot de passe + Confirmation sur la même ligne -->
        <div class="grid grid-cols-2 gap-3 mb-5">
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Mot de passe</label>
                <input type="password" name="password" required
                    class="w-full px-3 py-2 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-indigo-500 transition bg-gray-50 text-sm"
                    placeholder="Min. 8 caractères">
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Confirmer</label>
                <input type="password" name="password_confirmation" required
                    class="w-full px-3 py-2 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-indigo-500 transition bg-gray-50 text-sm"
                    placeholder="••••••••">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
            </div>
        </div>

        <!-- Bouton -->
        <button type="submit"
            class="w-full py-2.5 rounded-lg font-bold text-white transition shadow-md text-sm"
            style="background: linear-gradient(135deg, #065A82, #1C7293);">
            CRÉER MON COMPTE
        </button>

        <!-- Lien connexion -->
        <p class="text-center text-xs text-gray-500 mt-4">
            Déjà inscrit ?
            <a href="{{ route('login') }}" class="text-indigo-600 font-semibold hover:underline">Se connecter</a>
        </p>

    </form>
</x-guest-layout>