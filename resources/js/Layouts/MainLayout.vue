<template>
  <div class="min-h-screen bg-gray-100">
    <!-- Fixed Header -->
    <header class="fixed w-full bg-white shadow-md z-50">
      <div class="container mx-auto px-4">
        <div class="flex justify-between items-center h-16">
          <!-- Social Icons -->
          <div class="flex items-center space-x-4">
            <a href="#" class="text-gray-600 hover:text-gray-900">
              <i class="fab fa-instagram"></i>
            </a>
            <a href="#" class="text-gray-600 hover:text-gray-900">
              <i class="fab fa-facebook"></i>
            </a>
            <a href="#" class="text-gray-600 hover:text-gray-900">
              <i class="fab fa-whatsapp"></i>
            </a>
            <span class="text-gray-600">
              <i class="fas fa-map-marker-alt"></i>
              <span class="ml-2">Endereço da NovaTec</span>
            </span>
          </div>

          <!-- Logo -->
          <div class="flex-shrink-0">
            <img src="/images/logo.png" alt="NovaTec" class="h-8">
          </div>

          <!-- Navigation -->
          <nav class="hidden md:flex items-center space-x-8">
            <a href="#home" class="text-gray-600 hover:text-gray-900">Home</a>
            <a href="#servicos" class="text-gray-600 hover:text-gray-900">Serviços</a>
            <a href="#sobre" class="text-gray-600 hover:text-gray-900">Sobre</a>
            <a href="#contato" class="text-gray-600 hover:text-gray-900">Contato</a>
            <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
              Assine agora!
            </button>
            <a href="/login" class="text-gray-600 hover:text-gray-900">Área do Cliente</a>
          </nav>

          <!-- Mobile menu button -->
          <div class="md:hidden">
            <button @click="toggleMobileMenu" class="text-gray-600 hover:text-gray-900">
              <i class="fas fa-bars"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Mobile menu -->
      <div v-show="mobileMenuOpen" class="md:hidden">
        <div class="px-2 pt-2 pb-3 space-y-1">
          <a href="#home" class="block px-3 py-2 text-gray-600 hover:text-gray-900">Home</a>
          <a href="#servicos" class="block px-3 py-2 text-gray-600 hover:text-gray-900">Serviços</a>
          <a href="#sobre" class="block px-3 py-2 text-gray-600 hover:text-gray-900">Sobre</a>
          <a href="#contato" class="block px-3 py-2 text-gray-600 hover:text-gray-900">Contato</a>
          <button class="w-full text-left bg-blue-600 text-white px-3 py-2 rounded-lg hover:bg-blue-700">
            Assine agora!
          </button>
          <a href="/login" class="block px-3 py-2 text-gray-600 hover:text-gray-900">Área do Cliente</a>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <main class="pt-16">
      <slot></slot>
    </main>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const mobileMenuOpen = ref(false)

const toggleMobileMenu = () => {
  mobileMenuOpen.value = !mobileMenuOpen.value
}
</script>

<style>
html {
  scroll-behavior: smooth;
}
</style> 