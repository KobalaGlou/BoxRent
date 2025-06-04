<template>
  <footer class="bg-gray-900 text-white py-8 mt-12">
    <div class="container mx-auto grid grid-cols-2 md:grid-cols-5 gap-8 px-6">
      
      <!-- Colonne principale (Nom app + réseaux sociaux) -->
      <div class="col-span-2 md:col-span-2 flex flex-col items-start space-y-4">
        <h2 class="text-2xl font-bold">MonApp</h2>
        <div class="flex space-x-4 text-xl">
          <a href="#" class="hover:text-gray-400"><i class="fab fa-facebook"></i></a>
          <a href="#" class="hover:text-gray-400"><i class="fab fa-linkedin"></i></a>
          <a href="#" class="hover:text-gray-400"><i class="fab fa-youtube"></i></a>
          <a href="#" class="hover:text-gray-400"><i class="fab fa-instagram"></i></a>
        </div>
      </div>

      <!-- Colonne Liens -->
      <div>
        <h3 class="text-lg font-semibold mb-3">Liens</h3>
        <ul class="space-y-2 text-sm">
          <li><a href="/about" class="hover:underline">Qui sommes-nous</a></li>
          <li><a href="/rgpd" class="hover:underline">RGPD</a></li>
          <li><a href="/cgv" class="hover:underline">CGV</a></li>
        </ul>
      </div>

      <!-- Colonne Contacts -->
      <div>
        <h3 class="text-lg font-semibold mb-3">Contacts</h3>
        <ul class="space-y-2 text-sm">
          <li><a href="/data" class="hover:underline">Données personnelles</a></li>
          <li><a href="/remove-content" class="hover:underline">Suppression d'un contenu</a></li>
          <li><a href="/contact" class="hover:underline">Nous contacter</a></li>
        </ul>
      </div>

      <!-- Colonne Autres -->
      <div>
        <h3 class="text-lg font-semibold mb-3">Autres</h3>
        <ul class="space-y-2 text-sm">
          <li><a href="/faq" class="hover:underline">FAQ</a></li>
          <li><a href="/partners" class="hover:underline">Partenaires</a></li>
          <li><a href="/api-docs" class="hover:underline">Documentation API</a></li>
        </ul>
      </div>
      
    </div>
  </footer>
</template>
