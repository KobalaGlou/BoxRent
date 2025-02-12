<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier la Box') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-2xl font-bold mb-6">Modifier la Box</h1>

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('boxs.update', $box->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 font-bold mb-2">Nom</label>
                            <input type="text" name="name" id="name" value="{{ $box->name }}" 
                                class="form-control w-full border-gray-300 rounded-md" required>
                        </div>

                        <div class="mb-4">
                            <label for="desc" class="block text-gray-700 font-bold mb-2">Description</label>
                            <textarea name="desc" id="desc" 
                                class="form-control w-full border-gray-300 rounded-md">{{ $box->desc }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="lieux" class="block text-gray-700 font-bold mb-2">Lieux</label>
                            <input type="text" name="lieux" id="lieux" value="{{ $box->lieux }}" 
                                class="form-control w-full border-gray-300 rounded-md">
                        </div>

                        <div class="mb-4">
                            <label for="prix" class="block text-gray-700 font-bold mb-2">Prix</label>
                            <input type="number" name="prix" id="prix" value="{{ $box->prix }}" 
                                class="form-control w-full border-gray-300 rounded-md" step="0.01">
                        </div>

                        <div class="mb-4">
                            <label for="occupé" class="block text-gray-700 font-bold mb-2">Occupé</label>
                            <select name="occupé" id="occupé" class="form-control w-full border-gray-300 rounded-md">
                                <option value="0" {{ !$box->occupé ? 'selected' : '' }}>Non</option>
                                <option value="1" {{ $box->occupé ? 'selected' : '' }}>Oui</option>
                            </select>
                        </div>

                        <div class="flex items-center justify-end">
                            <a href="{{ route('boxs.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-4">
                                Annuler
                            </a>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Mettre à jour
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
