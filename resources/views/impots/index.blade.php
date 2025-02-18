<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Prévision des Impôts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Simulation de vos impôts fonciers</h3>

                    <p class="text-gray-700">Total des revenus locatifs sur l'année :
                        <strong>{{ number_format($revenusAnnuels, 2, ',', ' ') }} €</strong></p>
                    {{-- Partie Micro-foncier --}}
                    <h4 class="text-md font-semibold mt-4 text-blue-600">Régime Micro-Foncier</h4>
                    <p>Case <strong>4BE</strong> (Déclaration n°2042) :
                        <strong>{{ number_format($revenusAnnuels, 2, ',', ' ') }} €</strong></p>
                    <p>Montant imposé après abattement (70%) :
                        <strong>{{ number_format($revenusAnnuels * 0.7, 2, ',', ' ') }} €</strong></p>

                    {{-- Partie Réel --}}
                    <h4 class="text-md font-semibold mt-4 text-red-600">Régime Réel</h4>
                    <p>Case <strong>4BA</strong> (Déclaration n°2044) :
                        <strong>{{ number_format($revenusAnnuels, 2, ',', ' ') }} €</strong></p>
                    <p>Montant imposé : <strong>{{ number_format($revenusAnnuels, 2, ',', ' ') }} €</strong></p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
