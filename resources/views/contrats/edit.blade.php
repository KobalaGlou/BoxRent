<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier le Contrat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                            <strong class="font-bold">Erreurs :</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('contrats.update', $contrat->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label for="locataire_id" class="block text-gray-700 font-bold mb-2">Locataire :</label>
                            <select name="locataire_id" id="locataire_id"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required>
                                @foreach ($locataires as $locataire)
                                    <option value="{{ $locataire->id }}"
                                        {{ $locataire->id == $contrat->locataire_id ? 'selected' : '' }}>
                                        {{ $locataire->nom }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="box_id" class="block text-gray-700 font-bold mb-2">Box :</label>
                            <select name="box_id" id="box_id"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required>
                                @foreach ($boxes as $box)
                                    <option value="{{ $box->id }}"
                                        {{ $box->id == $contrat->box_id ? 'selected' : '' }}>{{ $box->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="date_debut" class="block text-gray-700 font-bold mb-2">Date de Début :</label>
                            <input type="date" name="date_debut" id="date_debut" value="{{ $contrat->date_debut }}"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required>
                        </div>

                        <div class="mb-4">
                            <label for="date_fin" class="block text-gray-700 font-bold mb-2">Date de Fin :</label>
                            <input type="date" name="date_fin" id="date_fin" value="{{ $contrat->date_fin }}"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>

                        <div class="mb-4">
                            <label for="prix_mois" class="block text-gray-700 font-bold mb-2">Prix Mensuel (€) :</label>
                            <input type="number" name="prix_mois" id="prix_mois" value="{{ $contrat->prix_mois }}"
                                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                required>
                        </div>
                        <div class="mb-4">
                            <label for="template_id" class="block text-sm font-medium text-gray-700">Modèle de
                                contrat</label>
                            <select name="template_id" id="template_id"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                <option value="">Sélectionner un modèle</option>
                                @foreach ($templates as $template)
                                    <option value="{{ $template->id }}"
                                        {{ $contrat->template_id == $template->id ? 'selected' : '' }}>
                                        {{ $template->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="flex items-center justify-between">
                            <button type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                Modifier le Contrat
                            </button>
                            <a href="{{ route('contrats.index') }}"
                                class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                                Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
