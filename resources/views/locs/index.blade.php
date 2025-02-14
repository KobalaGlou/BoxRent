<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mes Locataires') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Succès !</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Bouton pour ajouter un nouveau locataire -->
                    <div class="mb-6">
                        <a href="{{ route('locs.create') }}"
                           class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Ajouter un nouveau locataire
                        </a>
                    </div>

                    @if ($locataires->isEmpty())
                        <p>Vous n'avez pas encore de locataires.</p>
                    @else
                        <table class="min-w-full bg-white border border-gray-200">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 border-b">Nom</th>
                                    <th class="py-2 px-4 border-b">Téléphone</th>
                                    <th class="py-2 px-4 border-b">Email</th>
                                    <th class="py-2 px-4 border-b">Adresse</th>
                                    <th class="py-2 px-4 border-b ">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($locataires as $locataire)
                                    <tr>
                                        <td class="py-2 px-4 border-b text-center">{{ $locataire->nom }}</td>
                                        <td class="py-2 px-4 border-b text-center">{{ $locataire->tel }}</td>
                                        <td class="py-2 px-4 border-b text-center">{{ $locataire->email }}</td>
                                        <td class="py-2 px-4 border-b text-center">{{ $locataire->adresse }}</td>
                                        <td class="py-2 px-4 border-b text-right">
                                            <a href="{{ route('locs.edit', $locataire->id) }}"
                                               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
                                                Modifier
                                            </a>
                                            <form action="{{ route('locs.destroy', $locataire->id) }}" method="POST"
                                                  class="inline-block"
                                                  onsubmit="return confirm('Voulez-vous vraiment supprimer ce locataire ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                                    Supprimer
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
