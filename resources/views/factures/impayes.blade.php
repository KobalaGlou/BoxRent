<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Factures Impayées') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="min-w-full bg-white border">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 border-b">Numéro de Facture</th>
                                <th class="py-2 px-4 border-b">Montant (€)</th>
                                <th class="py-2 px-4 border-b">Locataire</th>
                                <th class="py-2 px-4 border-b">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($factures as $facture)
                                <tr>
                                    <td class="py-2 px-4 border-b text-center">{{ $facture->id }}</td>
                                    <td class="py-2 px-4 border-b text-center">{{ number_format($facture->montant, 2, ',', ' ') }}</td>
                                    <td class="py-2 px-4 border-b text-center">{{ $facture->contrat->locataire->nom }}</td>
                                    <td class="py-2 px-4 border-b text-center">
                                        <form action="{{ route('factures.update', $facture->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('PUT')
                                            <input type="date" name="date_paiement" required class="border rounded px-2 py-1">
                                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded">
                                                Valider le paiement
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-2 px-4 text-center">Aucune facture impayée trouvée.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <a href="{{ route('factures.historique') }}" 
                       class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Voir l'historique des factures
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
