<template>
  <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
      <div class="mb-4 text-sm text-gray-600">
        Obrigado por se cadastrar! Antes de começar, você precisa verificar seu endereço de e-mail clicando no link que acabamos de enviar para você. Se você não recebeu o e-mail, teremos prazer em enviar outro.
      </div>

      <div class="mt-4 flex items-center justify-between" v-if="status === 'verification-link-sent'">
        <div class="text-sm text-green-600">
          Um novo link de verificação foi enviado para o endereço de e-mail fornecido durante o registro.
        </div>
      </div>

      <div class="mt-4 flex items-center justify-between">
        <form @submit.prevent="submit">
          <div>
            <button type="submit"
              class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
              :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
              Reenviar e-mail de verificação
            </button>
          </div>
        </form>

        <form @submit.prevent="logout">
          <button type="submit"
            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Sair
          </button>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
  status: String,
})

const form = useForm({})

const submit = () => {
  form.post(route('verification.send'))
}

const logout = () => {
  form.post(route('logout'))
}
</script> 