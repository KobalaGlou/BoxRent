<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Créer un modèle de contrat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{ route('templates.store') }}" method="POST">
                        @csrf

                        <!-- Champ pour le nom du template -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">
                                Nom du modèle
                            </label>
                            <input type="text" name="name" id="name"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                required placeholder="Ex. Contrat de location standard">
                        </div>

                        <!-- Éditeur Quill -->
                        <div id="editor-container" style="height: 300px;"></div>
                        <input type="hidden" name="template_content" id="template_content">

                        <!-- Bouton de soumission -->
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-4">
                            Enregistrer le modèle
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var quill = new Quill('#editor-container', {
                theme: 'snow'
            });

            const form = document.querySelector('form');
            form.onsubmit = function() {
                const content = document.querySelector('#template_content');
                content.value = quill.root.innerHTML;
            };
        });
    </script>
@endpush
