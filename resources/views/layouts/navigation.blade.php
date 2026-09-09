<nav x-data="{ open: false }" style="background: linear-gradient(135deg, #065A82, #1C7293); box-shadow: 0 2px 8px rgba(0,0,0,0.15);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-white" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-2 sm:-my-px sm:ms-10 sm:flex items-center">
                    <a href="{{ route('dashboard') }}"
                        class="px-4 py-2 rounded-lg text-sm font-semibold transition
                        {{ request()->routeIs('dashboard') ? 'bg-white text-indigo-700' : 'text-white hover:bg-white hover:bg-opacity-20' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('offres.index') }}"
                        class="px-4 py-2 rounded-lg text-sm font-semibold transition
                        {{ request()->routeIs('offres.*') ? 'bg-white text-indigo-700' : 'text-white hover:bg-white hover:bg-opacity-20' }}">
                        Offres
                    </a>
                    @if(auth()->user()->isClient())
                    <a href="{{ route('candidatures.received') }}"
                        class="px-4 py-2 rounded-lg text-sm font-semibold transition
                        {{ request()->routeIs('candidatures.received') ? 'bg-white text-indigo-700' : 'text-white hover:bg-white hover:bg-opacity-20' }}">
                        Candidatures reçues
                    </a>
                    @endif
                    @if(auth()->user()->isFreelance())
                    <a href="{{ route('candidatures.index') }}"
                        class="px-4 py-2 rounded-lg text-sm font-semibold transition
                        {{ request()->routeIs('candidatures.index') ? 'bg-white text-indigo-700' : 'text-white hover:bg-white hover:bg-opacity-20' }}">
                        Mes candidatures
                    </a>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border border-white border-opacity-40 text-sm font-semibold rounded-lg text-white hover:bg-white hover:bg-opacity-20 focus:outline-none transition">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-2">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profil.show')">
                            Mon Profil
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Se déconnecter
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-white hover:bg-white hover:bg-opacity-20 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden" style="background: #054a6e;">
        <div class="pt-2 pb-3 space-y-1 px-3">
            <a href="{{ route('dashboard') }}"
                class="block px-4 py-2 rounded-lg text-sm font-semibold text-white hover:bg-white hover:bg-opacity-20 transition">
                Dashboard
            </a>
            <a href="{{ route('offres.index') }}"
                class="block px-4 py-2 rounded-lg text-sm font-semibold text-white hover:bg-white hover:bg-opacity-20 transition">
                Offres
            </a>
        </div>

        <div class="pt-4 pb-3 border-t border-white border-opacity-20">
            <div class="px-4 mb-3">
                <div class="font-semibold text-white">{{ Auth::user()->name }}</div>
                <div class="text-sm text-blue-200">{{ Auth::user()->email }}</div>
            </div>
            <div class="space-y-1 px-3">
                <a href="{{ route('profil.show') }}"
                    class="block px-4 py-2 rounded-lg text-sm font-semibold text-white hover:bg-white hover:bg-opacity-20 transition">
                    Mon Profil
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full text-left px-4 py-2 rounded-lg text-sm font-semibold text-white hover:bg-white hover:bg-opacity-20 transition">
                        Se déconnecter
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>