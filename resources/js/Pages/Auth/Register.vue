<template>
  <GuestLayout>
    <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
      <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        <h2 class="text-2xl font-bold text-center text-gray-900 mb-8">
          Registre sua Empresa
        </h2>

        <form @submit.prevent="submit">
          <!-- Nome Completo -->
          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
              Nome Completo
            </label>
            <input
              id="name"
              type="text"
              v-model="form.name"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              :class="{ 'border-red-500': form.errors.name }"
              required
            >
            <div v-if="form.errors.name" class="text-red-500 text-xs mt-1">
              {{ form.errors.name }}
            </div>
          </div>

          <!-- Email -->
          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
              E-mail
            </label>
            <input
              id="email"
              type="email"
              v-model="form.email"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              :class="{ 'border-red-500': form.errors.email }"
              required
            >
            <div v-if="form.errors.email" class="text-red-500 text-xs mt-1">
              {{ form.errors.email }}
            </div>
          </div>

          <!-- Nome da Empresa -->
          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="company_name">
              Nome da Empresa
            </label>
            <input
              id="company_name"
              type="text"
              v-model="form.company_name"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              :class="{ 'border-red-500': form.errors.company_name }"
              required
            >
            <div v-if="form.errors.company_name" class="text-red-500 text-xs mt-1">
              {{ form.errors.company_name }}
            </div>
          </div>

          <!-- Telefone -->
          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">
              Telefone
            </label>
            <input
              id="phone"
              type="tel"
              v-model="form.phone"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              :class="{ 'border-red-500': form.errors.phone }"
              required
            >
            <div v-if="form.errors.phone" class="text-red-500 text-xs mt-1">
              {{ form.errors.phone }}
            </div>
          </div>

          <!-- Senha -->
          <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
              Senha
            </label>
            <input
              id="password"
              type="password"
              v-model="form.password"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              :class="{ 'border-red-500': form.errors.password }"
              required
            >
            <div v-if="form.errors.password" class="text-red-500 text-xs mt-1">
              {{ form.errors.password }}
            </div>
          </div>

          <!-- Confirmação de Senha -->
          <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password_confirmation">
              Confirme a Senha
            </label>
            <input
              id="password_confirmation"
              type="password"
              v-model="form.password_confirmation"
              class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              required
            >
          </div>

          <!-- Botão de Submit -->
          <div class="flex items-center justify-between">
            <button
              type="submit"
              class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
              :disabled="form.processing"
            >
              {{ form.processing ? 'Registrando...' : 'Registrar' }}
            </button>
          </div>

          <!-- Link para Login -->
          <div class="mt-4 text-center">
            <Link
              :href="route('login')"
              class="text-sm text-blue-600 hover:text-blue-800"
            >
              Já tem uma conta? Faça login
            </Link>
          </div>
        </form>
      </div>
    </div>
  </GuestLayout>
</template>

<script setup>
import { useForm, Link } from '@inertiajs/vue3'
import GuestLayout from '@/Layouts/GuestLayout.vue'

const form = useForm({
  name: '',
  email: '',
  company_name: '',
  phone: '',
  password: '',
  password_confirmation: '',
})

const submit = () => {
  form.post(route('register'), {
    onFinish: () => {
      form.reset('password', 'password_confirmation')
    },
  })
}
</script> 