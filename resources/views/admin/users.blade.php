<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Gestion des utilisateurs
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <table class="w-full text-sm text-left">
                    <thead class="bg-gray-50 text-gray-700 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-3">Nom</th>
                            <th class="px-6 py-3">Email</th>
                            <th class="px-6 py-3">Rôle</th>
                            <th class="px-6 py-3">Inscrit le</th>
                            <th class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-800">{{ $user->name }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $user->email }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold
                                    {{ $user->role == 'admin' ? 'bg-red-100 text-red-700' : '' }}
                                    {{ $user->role == 'client' ? 'bg-green-100 text-green-700' : '' }}
                                    {{ $user->role == 'freelance' ? 'bg-indigo-100 text-indigo-700' : '' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-gray-500">{{ $user->created_at->format('d/m/Y') }}</td>
                            <td class="px-6 py-4">
                                @if($user->id !== auth()->id())
                                <form method="POST" action="{{ route('admin.users.delete', $user) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        onclick="return confirm('Supprimer cet utilisateur ?')"
                                        class="bg-red-500 text-white px-3 py-1 rounded text-xs hover:bg-red-600">
                                        Supprimer
                                    </button>
                                </form>
                                @else
                                <span class="text-gray-400 text-xs">Vous</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="p-4">
                    {{ $users->links() }}
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