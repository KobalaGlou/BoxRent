<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier un locataire') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('locs.update', $locataire->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Nom -->
                        <div class="mb-4">
                            <label for="nom" class="block text-gray-700 font-bold mb-2">Nom :</label>
                            <input type="text" id="nom" name="nom" value="{{ old('nom', $locataire->nom) }}"
                                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                            @error('nom')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Téléphone -->
                        <div class="mb-4">
                            <label for="tel" class="block text-gray-700 font-bold mb-2">Téléphone :</label>
                            <input type="text" id="tel" name="tel" value="{{ old('tel', $locataire->tel) }}"
                                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                            @error('tel')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 font-bold mb-2">Email :</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $locataire->email) }}"
                                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Adresse -->
                        <div class="mb-4">
                            <label for="adresse" class="block text-gray-700 font-bold mb-2">Adresse :</label>
                            <textarea id="adresse" name="adresse" rows="3"
                                      class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">{{ old('adresse', $locataire->adresse) }}</textarea>
                            @error('adresse')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Compte Bancaire -->
                        <div class="mb-4">
                            <label for="compte_bancaire" class="block text-gray-700 font-bold mb-2">Compte Bancaire :</label>
                            <input type="text" id="compte_bancaire" name="compte_bancaire" value="{{ old('compte_bancaire', $locataire->compte_bancaire) }}"
                                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                            @error('compte_bancaire')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Boutons d'action -->
                        <div class="flex justify-end">
                            <a href="{{ route('locs.index') }}"
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded mr-2">
                                Annuler
                            </a>
                            <button type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
