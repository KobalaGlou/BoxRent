<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Aperçu du Contrat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                
                <h3 class="text-lg font-semibold mb-4">📜 Template original avec balises :</h3>
                <div class="border p-4 bg-gray-100">
                    {!! $template->content !!} {{-- Affichage brut avec balises --}}
                </div>

                <h3 class="text-lg font-semibold mt-6 mb-4">✅ Contrat avec valeurs réelles :</h3>
                <div class="border p-4 bg-green-100">
                    {!! $renderedContent !!} {{-- Affichage avec valeurs remplies --}}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
