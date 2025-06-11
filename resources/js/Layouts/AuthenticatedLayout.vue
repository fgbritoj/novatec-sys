<template>
  <div class="min-h-screen bg-gray-100">
    <!-- Navigation Bar -->
    <nav class="bg-white border-b border-gray-100">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
          <div class="flex">
            <!-- Logo -->
            <div class="shrink-0 flex items-center">
              <Link :href="route('home')" class="text-xl font-bold text-blue-600">
                NovaTec
              </Link>
            </div>

            <!-- Navigation Links -->
            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
              <template v-if="$page.props.auth.user.role === 'admin'">
                <Link
                  :href="route('admin.dashboard')"
                  class="inline-flex items-center px-1 pt-1 border-b-2"
                  :class="[
                    route().current('admin.dashboard')
                      ? 'border-blue-400 text-gray-900'
                      : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'
                  ]"
                >
                  Dashboard
                </Link>
              </template>
              <template v-else>
                <Link
                  :href="route('client.dashboard')"
                  class="inline-flex items-center px-1 pt-1 border-b-2"
                  :class="[
                    route().current('client.dashboard')
                      ? 'border-blue-400 text-gray-900'
                      : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'
                  ]"
                >
                  Dashboard
                </Link>
                <Link
                  :href="route('client.quotes')"
                  class="inline-flex items-center px-1 pt-1 border-b-2"
                  :class="[
                    route().current('client.quotes')
                      ? 'border-blue-400 text-gray-900'
                      : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'
                  ]"
                >
                  Orçamentos
                </Link>
                <Link
                  :href="route('client.equipment')"
                  class="inline-flex items-center px-1 pt-1 border-b-2"
                  :class="[
                    route().current('client.equipment')
                      ? 'border-blue-400 text-gray-900'
                      : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'
                  ]"
                >
                  Equipamentos
                </Link>
                <Link
                  :href="route('client.receipts')"
                  class="inline-flex items-center px-1 pt-1 border-b-2"
                  :class="[
                    route().current('client.receipts')
                      ? 'border-blue-400 text-gray-900'
                      : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'
                  ]"
                >
                  Comprovantes
                </Link>
              </template>
            </div>
          </div>

          <!-- User Dropdown -->
          <div class="hidden sm:flex sm:items-center sm:ml-6">
            <div class="ml-3 relative">
              <button
                @click="showingNavigationDropdown = !showingNavigationDropdown"
                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
              >
                {{ $page.props.auth.user.name }}
                <i class="fas fa-chevron-down ml-2"></i>
              </button>

              <!-- Dropdown Menu -->
              <div
                v-show="showingNavigationDropdown"
                class="absolute right-0 z-50 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5"
              >
                <form @submit.prevent="logout">
                  <button
                    type="submit"
                    class="w-full text-left block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
                  >
                    Sair
                  </button>
                </form>
              </div>
            </div>
          </div>

          <!-- Hamburger -->
          <div class="-mr-2 flex items-center sm:hidden">
            <button
              @click="showingNavigationDropdown = !showingNavigationDropdown"
              class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
            >
              <i class="fas fa-bars"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Responsive Navigation Menu -->
      <div
        :class="{'block': showingNavigationDropdown, 'hidden': !showingNavigationDropdown}"
        class="sm:hidden"
      >
        <div class="pt-2 pb-3 space-y-1">
          <template v-if="$page.props.auth.user.role === 'admin'">
            <Link
              :href="route('admin.dashboard')"
              class="block pl-3 pr-4 py-2 border-l-4"
              :class="[
                route().current('admin.dashboard')
                  ? 'border-blue-400 text-blue-700 bg-blue-50'
                  : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300'
              ]"
            >
              Dashboard
            </Link>
          </template>
          <template v-else>
            <Link
              :href="route('client.dashboard')"
              class="block pl-3 pr-4 py-2 border-l-4"
              :class="[
                route().current('client.dashboard')
                  ? 'border-blue-400 text-blue-700 bg-blue-50'
                  : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300'
              ]"
            >
              Dashboard
            </Link>
            <Link
              :href="route('client.quotes')"
              class="block pl-3 pr-4 py-2 border-l-4"
              :class="[
                route().current('client.quotes')
                  ? 'border-blue-400 text-blue-700 bg-blue-50'
                  : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300'
              ]"
            >
              Orçamentos
            </Link>
            <Link
              :href="route('client.equipment')"
              class="block pl-3 pr-4 py-2 border-l-4"
              :class="[
                route().current('client.equipment')
                  ? 'border-blue-400 text-blue-700 bg-blue-50'
                  : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300'
              ]"
            >
              Equipamentos
            </Link>
            <Link
              :href="route('client.receipts')"
              class="block pl-3 pr-4 py-2 border-l-4"
              :class="[
                route().current('client.receipts')
                  ? 'border-blue-400 text-blue-700 bg-blue-50'
                  : 'border-transparent text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300'
              ]"
            >
              Comprovantes
            </Link>
          </template>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
          <div class="px-4">
            <div class="font-medium text-base text-gray-800">
              {{ $page.props.auth.user.name }}
            </div>
            <div class="font-medium text-sm text-gray-500">
              {{ $page.props.auth.user.email }}
            </div>
          </div>

          <div class="mt-3 space-y-1">
            <form @submit.prevent="logout">
              <button
                type="submit"
                class="block w-full text-left px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out"
              >
                Sair
              </button>
            </form>
          </div>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <main>
      <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <slot></slot>
        </div>
      </div>
    </main>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { Link, router } from '@inertiajs/vue3'

const showingNavigationDropdown = ref(false)

const logout = () => {
  router.post(route('logout'))
}
</script> 