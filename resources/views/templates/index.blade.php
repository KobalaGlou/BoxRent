<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mes Templates de Contrat') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <a href="{{ route('templates.create') }}" class="inline-block bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Créer un Template</a>
                    
                    
                    @if ($templates->isEmpty())
                        <div class="mt-4">
                            <p class="text-gray-600">Aucun template n'a encore été créé.</p>
                        </div>
                    @else
                        <table class="min-w-full mt-4 border-collapse border border-gray-200">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border border-gray-300 px-4 py-2">ID Template</th>
                                    <th class="border border-gray-300 px-4 py-2">Nom</th>
                                    <th class="border border-gray-300 px-4 py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($templates as $template)
                                    <tr>
                                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $template->id }}</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">{{ $template->name }}</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">
                                            <a href="{{ route('templates.edit', $template) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mr-2 ">Modifier</a>
                                            <form action="{{ route('templates.destroy', $template) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded " onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce template ?')">Supprimer</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
