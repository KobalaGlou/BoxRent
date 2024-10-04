<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mes Boxs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if($boxs->isEmpty())
                        <p>Vous n'avez pas encore de box.</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($boxs as $box)
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
                                        <div class="mt-4">
                                            <a href="{{ route('boxs.index', $box->id) }}" class="inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                Voir détails
                                            </a>
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