<x-app-layout>

    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.0/dist/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.0/dist/quill.min.js"></script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier le modèle de contrat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('templates.update', $template->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Champ pour le nom du template -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nom du modèle</label>
                            <input type="text" name="name" id="name" value="{{ $template->name }}"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                required>
                        </div>

                        <!-- Éditeur Quill -->
                        <div id="editor-container" style="height: 300px;"></div>
                        <input type="hidden" name="content" id="content" value="{{ $template->content }}">

                        <!-- Bouton de soumission -->
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-4">
                            Mettre à jour
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Initialisation de Quill
                var quill = new Quill('#editor-container', {
                    theme: 'snow',
                    placeholder: 'Modifie ton contrat ici...',
                    modules: {
                        toolbar: [
                            [{ 'header': [1, 2, false] }],
                            ['bold', 'italic', 'underline'],
                            ['link', 'blockquote', 'code-block'],
                            [{ 'list': 'ordered' }, { 'list': 'bullet' }]
                        ]
                    }
                });

                // Charger le contenu actuel dans Quill
                quill.root.innerHTML = document.querySelector('#content').value;

                const contentInput = document.querySelector('#content');
                const form = document.querySelector('form');

                // Met à jour #content chaque fois que Quill change
                quill.on('text-change', function() {
                    contentInput.value = quill.root.innerHTML;
                });

                // Debugging dans la console
                form.onsubmit = function(event) {
                    console.log('Contenu Quill avant envoi:', contentInput.value);

                    // Empêcher l'envoi si le contenu est vide
                    if (!contentInput.value.trim()) {
                        alert("Le contenu du contrat ne peut pas être vide !");
                        event.preventDefault();
                    }
                };
            });
        </script>
    @endpush

</x-app-layout>
