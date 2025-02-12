<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Créer une Box') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-6">
        <h1 class="text-2xl font-bold mb-4">Créer une Box</h1>

        <!-- Affichage des erreurs -->
        @if($errors->any())
            <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulaire de création -->
        <form action="{{ route('boxs.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200" required>
            </div>
            <div class="mb-4">
                <label for="desc" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="desc" id="desc" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200"></textarea>
            </div>
            <div class="mb-4">
                <label for="lieux" class="block text-sm font-medium text-gray-700">Lieu</label>
                <input type="text" name="lieux" id="lieux" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200">
            </div>
            <div class="mb-4">
                <label for="prix" class="block text-sm font-medium text-gray-700">Prix</label>
                <input type="number" name="prix" id="prix" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200" step="0.01">
            </div>
            <div class="mb-4">
                <label for="occupé" class="block text-sm font-medium text-gray-700">Occupé</label>
                <select name="occupé" id="occupé" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-indigo-200">
                    <option value="0">Non</option>
                    <option value="1">Oui</option>
                </select>
            </div>
            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Créer</button>
        </form>
    </div>
</x-app-layout>
