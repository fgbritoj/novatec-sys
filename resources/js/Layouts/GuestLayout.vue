<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Fixed Header -->
    <header class="fixed w-full bg-white shadow-md z-50">
      <div class="container mx-auto px-4">
        <!-- Social Icons Bar - Only show on home page -->
        <Transition
          enter-active-class="transition-all duration-1000 ease-out"
          enter-from-class="opacity-0 -translate-y-full"
          enter-to-class="opacity-100 translate-y-0"
          leave-active-class="transition-all duration-1000 ease-in"
          leave-from-class="opacity-100 translate-y-0"
          leave-to-class="opacity-0 -translate-y-full"
          appear
        >
          <div v-show="isHomePage" class="social-bar flex justify-between items-center py-2 border-b border-gray-100">
            <div class="flex items-center space-x-4">
              <a href="#" class="text-gray-600 hover:text-blue-600" title="Instagram">
                <i class="fab fa-instagram"></i>
              </a>
              <a href="#" class="text-gray-600 hover:text-blue-800" title="Facebook">
                <i class="fab fa-facebook"></i>
              </a>
              <a href="#" class="text-gray-600 hover:text-green-600" title="WhatsApp">
                <i class="fab fa-whatsapp"></i>
              </a>
              <span class="text-gray-600">
                <i class="fas fa-map-marker-alt"></i>
                <span class="ml-2 text-sm">Rua Example, 123 - Cidade</span>
              </span>
            </div>
          </div>
        </Transition>

        <nav class="flex justify-between items-center py-4 relative">
          <!-- Logo - Always visible -->
          <a href="/" class="text-2xl font-bold text-blue-600 z-10">
            NovaTec
          </a>

          <!-- Navigation Menu -->
          <div class="hidden md:flex items-center space-x-8">
            <!-- Home Page Menu -->
            <Transition
              enter-active-class="transition-all duration-1000 ease-out"
              enter-from-class="opacity-0 translate-x-full"
              enter-to-class="opacity-100 translate-x-0"
              leave-active-class="transition-all duration-1000 ease-in"
              leave-from-class="opacity-100 translate-x-0"
              leave-to-class="opacity-0 translate-x-full"
              appear
            >
              <div v-show="isHomePage" class="menu-items flex items-center space-x-8">
                <button @click="scrollToSection('home')" 
                        class="text-gray-600 hover:text-blue-600 transform transition-transform">
                  Home
                </button>
                <button @click="scrollToSection('servicos')" 
                        class="text-gray-600 hover:text-blue-600 transform transition-transform">
                  Serviços
                </button>
                <button @click="scrollToSection('sobre')" 
                        class="text-gray-600 hover:text-blue-600 transform transition-transform">
                  Sobre
                </button>
                <button @click="scrollToSection('contato')" 
                        class="text-gray-600 hover:text-blue-600 transform transition-transform">
                  Contato
                </button>
                <button @click="visitLogin" class="inline-flex items-center text-gray-600 hover:text-blue-600 transform transition-transform">
                  <i class="fas fa-user mr-2"></i>Área do Cliente
                </button>
              </div>
            </Transition>

            <!-- Client Area Menu -->
            <Transition
              enter-active-class="transition-all duration-1000 ease-out"
              enter-from-class="opacity-0 scale-95"
              enter-to-class="opacity-100 scale-100"
              leave-active-class="transition-all duration-1000 ease-in"
              leave-from-class="opacity-100 scale-100"
              leave-to-class="opacity-0 scale-95"
              appear
            >
              <div v-show="!isHomePage" class="client-menu flex-1 flex justify-center">
                <Link href="/" class="text-gray-600 hover:text-blue-600">
                  Home
                </Link>
              </div>
            </Transition>

            <!-- Register Button - Always visible but with position transition -->
            <div class="register-button relative z-10 transition-all duration-1000" 
                 :class="{ 'ml-auto': !isHomePage }">
              <Link :href="route('register')" 
                    class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition-colors">
                Assine agora!
              </Link>
            </div>
          </div>

          <!-- Mobile Menu Button -->
          <Transition
            enter-active-class="transition-all duration-1000 ease-out"
            enter-from-class="opacity-0 scale-95"
            enter-to-class="opacity-100 scale-100"
            leave-active-class="transition-all duration-1000 ease-in"
            leave-from-class="opacity-100 scale-100"
            leave-to-class="opacity-0 scale-95"
            appear
          >
            <button v-show="isHomePage" class="md:hidden text-gray-600" @click="toggleMobileMenu">
              <i class="fas fa-bars"></i>
            </button>
          </Transition>
        </nav>
      </div>
    </header>

    <!-- Mobile Menu -->
    <Transition
      enter-active-class="transition-all duration-1000 ease-out"
      enter-from-class="opacity-0 -translate-x-full"
      enter-to-class="opacity-100 translate-x-0"
      leave-active-class="transition-all duration-1000 ease-in"
      leave-from-class="opacity-100 translate-x-0"
      leave-to-class="opacity-0 -translate-x-full"
    >
      <div v-show="mobileMenuOpen" class="fixed inset-0 bg-gray-800 bg-opacity-50 z-40">
        <div class="bg-white w-64 h-full transform">
          <div class="p-4 border-b">
            <button class="text-gray-600" @click="toggleMobileMenu">
              <i class="fas fa-times"></i>
            </button>
          </div>
          <div class="p-4 flex flex-col space-y-4">
            <template v-if="isHomePage">
              <button @click="scrollToSection('home')" class="text-gray-600 text-left">
                Home
              </button>
              <button @click="scrollToSection('servicos')" class="text-gray-600 text-left">
                Serviços
              </button>
              <button @click="scrollToSection('sobre')" class="text-gray-600 text-left">
                Sobre
              </button>
              <button @click="scrollToSection('contato')" class="text-gray-600 text-left">
                Contato
              </button>
              <Link :href="route('register')" class="bg-blue-600 text-white px-4 py-2 rounded-full text-center">
                Assine agora!
              </Link>
              <button @click="visitLogin" class="inline-flex items-center text-gray-600">
                <i class="fas fa-user mr-2"></i>Área do Cliente
              </button>
            </template>
            <template v-else>
              <Link href="/" class="text-gray-600">
                Home
              </Link>
              <Link :href="route('register')" class="bg-blue-600 text-white px-4 py-2 rounded-full text-center">
                Assine agora!
              </Link>
            </template>
          </div>
        </div>
      </div>
    </Transition>

    <!-- Main Content -->
    <main class="pt-16">
      <slot></slot>
    </main>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'
import { Link, router, usePage } from '@inertiajs/vue3'

const mobileMenuOpen = ref(false)

const isHomePage = computed(() => {
  return usePage().url === '/'
})

const toggleMobileMenu = () => {
  mobileMenuOpen.value = !mobileMenuOpen.value
}

const visitLogin = () => {
  router.visit(route('login'))
}

const scrollToSection = (sectionId) => {
  const section = document.getElementById(sectionId)
  const header = document.querySelector('header')
  const headerOffset = header ? header.offsetHeight : 0

  if (section) {
    const elementPosition = section.getBoundingClientRect().top
    const offsetPosition = elementPosition + window.pageYOffset - headerOffset

    window.scrollTo({
      top: offsetPosition,
      behavior: 'smooth'
    })
  }
  
  // Fecha o menu mobile se estiver aberto
  mobileMenuOpen.value = false
}
</script>

<style>
html {
  scroll-behavior: smooth;
  scroll-padding-top: 4rem; /* Ajustado para melhor alinhamento */
}

/* Transições suaves para elementos do menu */
.menu-items a,
.menu-items button {
  transition: all 1s ease-in-out;
}

/* Transição para o botão de registro */
.register-button {
  transition: all 1s ease-in-out;
}

/* Transição para a barra social */
.social-bar {
  transition: all 1s ease-in-out;
}

/* Transição para o menu do cliente */
.client-menu {
  transition: all 1s ease-in-out;
}

/* Garante que as transições sejam suaves */
.transition-all {
  transition-duration: 1000ms !important;
}

/* Remove a transição de hover para evitar conflitos */
a:hover,
button:hover {
  transition-duration: 150ms;
}

/* Ajustes para garantir que as transições funcionem corretamente */
.transform {
  will-change: transform;
}

.opacity-transition {
  will-change: opacity;
}

/* Garante que os elementos em transição não causem scroll horizontal */
.overflow-x-hidden {
  overflow-x: hidden;
}

/* Estilos para os botões de navegação */
.menu-items button {
  background: none;
  border: none;
  cursor: pointer;
  font: inherit;
  padding: 0;
}

/* Ajuste para os botões do menu mobile */
.mobile-menu button {
  width: 100%;
  text-align: left;
  padding: 0.5rem 0;
}
</style> 