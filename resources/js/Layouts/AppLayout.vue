<script setup>
import LoggedNavBar from '@/Components/Partials/Navbars/LoggedNavBar.vue'
import AppFooter from '@/Components/Partials/Footers/AppFooter.vue'
</script>

<template>
  <div class="min-h-screen flex flex-col bg-gray-100">
    <!-- Navbar -->
    <LoggedNavBar />

    <!-- Contenu principal -->
    <main class="flex-1 container mx-auto px-4 py-6">
      <slot />
    </main>

    <!-- Footer -->
    <AppFooter />
  </div>
</template>
