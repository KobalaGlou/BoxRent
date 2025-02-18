<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mes Contrats') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Affichage des messages de succès -->
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Bouton pour générer les factures -->
                    <form action="{{ route('factures.generer') }}" method="POST" class="mb-4">
                        @csrf
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Générer les factures du mois
                        </button>
                    </form>

                    <!-- Bouton Ajouter un contrat -->
                    <a href="{{ route('contrats.create') }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
                        Ajouter un contrat
                    </a>

                    <!-- Tableau des contrats -->
                    <table class="min-w-full bg-white border">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b">Locataire</th>
                                <th class="py-2 px-4 border-b">Box</th>
                                <th class="py-2 px-4 border-b">Date Début</th>
                                <th class="py-2 px-4 border-b">Date Fin</th>
                                <th class="py-2 px-4 border-b">Prix Mensuel</th>
                                <th class="py-2 px-4 border-b">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($contrats as $contrat)
                                <tr>
                                    <td class="py-2 px-4 border-b">{{ $contrat->locataire->nom }}</td>
                                    <td class="py-2 px-4 border-b">{{ $contrat->box->nom }}</td>
                                    <td class="py-2 px-4 border-b">{{ $contrat->date_debut }}</td>
                                    <td class="py-2 px-4 border-b">{{ $contrat->date_fin }}</td>
                                    <td class="py-2 px-4 border-b">{{ $contrat->prix_mois }} €</td>

                                    <!-- Colonne Actions -->
                                    <td class="py-2 px-4 border-b">
                                        @if ($contrat->template_id)
                                            <a href="{{ route('contrats.render', ['template' => $contrat->template_id, 'contrat' => $contrat->id]) }}"
                                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">
                                                Aperçu
                                            </a>
                                        @else
                                            <span class="text-gray-500">Aucun modèle</span>
                                        @endif

                                        <a href="{{ route('contrats.edit', $contrat->id) }}"
                                            class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded">
                                            Modifier
                                        </a>

                                        <form action="{{ route('contrats.destroy', $contrat->id) }}" method="POST"
                                            class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce contrat ?')">
                                                Supprimer
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="py-2 px-4 text-center">Aucun contrat trouvé.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
