<x-app-layout>

    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.0/dist/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.0/dist/quill.min.js"></script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Créer un modèle de contrat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('templates.store') }}" method="POST">
                        @csrf

                        <!-- Champ pour le nom du template -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nom du modèle</label>
                            <input type="text" name="name" id="name"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                                required placeholder="Ex. Contrat de location standard">
                        </div>

                        <!-- Éditeur Quill -->

                        <!-- Liste des balises dynamiques -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Insérer une balise dynamique
                                :</label>
                            <select id="insert-placeholder"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm sm:text-sm">
                                <option value="">-- Sélectionner une balise --</option>
                                <option value="[NAME]">Nom du client</option>
                                <option value="[BOX]">Nom du box</option>
                                <option value="[DATE_D]">Date de début</option>
                                <option value="[DATE_F]">Date de fin</option>
                                <option value="[PRIX]">Prix mensuel</option>
                            </select>
                        </div>
                        <div id="editor-container" style="height: 300px;"></div>
                        <input type="hidden" name="content" id="content">

                        <!-- 🔍 Zone de debug pour voir le contenu -->
                        <label for="debug-content" class="block text-sm font-medium text-gray-700 mt-4">
                            Aperçu du contenu généré :
                        </label>
                        <textarea id="debug-content" class="w-full h-32 border mt-2 p-2 bg-gray-100" readonly></textarea>

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

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var quill = new Quill('#editor-container', {
                    theme: 'snow',
                    placeholder: 'Écris ton contrat ici...',
                    modules: {
                        toolbar: [
                            [{
                                'header': [1, 2, false]
                            }],
                            ['bold', 'italic', 'underline'],
                            ['link', 'blockquote', 'code-block'],
                            [{
                                'list': 'ordered'
                            }, {
                                'list': 'bullet'
                            }]
                        ]
                    }
                });

                const contentInput = document.querySelector('#content');
                const debugTextarea = document.querySelector('#debug-content');
                const form = document.querySelector('form');

                // Met à jour le champ caché et le textarea de debug
                quill.on('text-change', function() {
                    contentInput.value = quill.root.innerHTML.trim();
                    debugTextarea.value = contentInput.value; // Affiche dans le textarea
                });

                // Gestion de l'insertion des balises dynamiques
                const selectPlaceholder = document.getElementById('insert-placeholder');

                selectPlaceholder.addEventListener('change', function() {
                    if (this.value) {
                        const cursorPosition = quill.getSelection().index; // Récupérer position du curseur
                        quill.insertText(cursorPosition, this.value + " "); // Insérer le texte
                        quill.setSelection(cursorPosition + this.value.length +
                        1); // Déplacer le curseur après le texte
                        this.value = ""; // Réinitialiser le select
                    }
                });

                // Debug dans la console avant envoi
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
