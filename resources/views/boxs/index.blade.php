<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mes Boxs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-blue-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                    role="alert">
                    <strong class="font-bold">Succès !</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Bouton pour créer une nouvelle box -->
                    <div class="mb-6">
                        <a href="{{ route('boxs.create') }}"
                            class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Ajouter une nouvelle box
                        </a>
                    </div>
                    @if ($boxs->isEmpty())
                        <p>Vous n'avez pas encore de box.</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($boxs as $box)
                                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                                    <div class="p-4">
                                        <h3 class="font-bold text-xl mb-2">{{ $box->name }}</h3>
                                        <p class="text-gray-700 text-base">
                                            <strong>Description:</strong> {{ $box->desc ?? 'Aucune description' }}<br>
                                            <strong>Lieu:</strong> {{ $box->lieux }}<br>
                                            <strong>Prix:</strong> {{ $box->prix }} €<br>
                                            <strong>Statut:</strong>
                                            <span class="{{ $box->occupé ? 'text-red-500' : 'text-green-500' }}">
                                                {{ $box->occupé ? 'Occupé' : 'Libre' }}
                                            </span>
                                        </p>
                                        <div class="mt-4 flex justify-between items-center">
                                            <a href="{{ route('boxs.index', $box->id) }}"
                                                class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                Voir détails
                                            </a>
                                            <a href="{{ route('boxs.edit', $box->id) }}"
                                                class="inline-block bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                                Modifier
                                            </a>
                                            <form action="{{ route('boxs.destroy', $box->id) }}" method="POST"
                                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette box ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-block bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                                    Supprimer
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
