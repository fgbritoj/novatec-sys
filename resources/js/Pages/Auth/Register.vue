<template>
  <GuestLayout>
    <div class="flex flex-col sm:justify-center items-center pt-24 sm:pt-24 bg-gradient-to-r from-blue-600 to-blue-800 min-h-screen">
      <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white shadow-xl overflow-hidden sm:rounded-lg">
        <h2 class="text-2xl font-bold text-center text-gray-900 mb-8">
          Registre sua Empresa
        </h2>

        <form @submit.prevent="submit" autocomplete="off" spellcheck="false">
          <input type="text" style="display:none">
          <input type="password" style="display:none">
          
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
              :class="{ 'border-red-500': form.errors.name, 'border-green-500': form.name && !form.errors.name }"
              required
              @input="validateName"
              @blur="validateName"
              autocomplete="off"
              spellcheck="false"
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
              :class="{ 'border-red-500': form.errors.email, 'border-green-500': form.email && !form.errors.email }"
              required
              @input="validateEmail"
              @blur="checkEmailAvailability"
              autocomplete="off"
              spellcheck="false"
            >
            <div v-if="form.errors.email" class="text-red-500 text-xs mt-1">
              {{ form.errors.email }}
            </div>
            <div v-if="isCheckingEmail" class="text-blue-500 text-xs mt-1">
              Verificando disponibilidade do e-mail...
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
              :class="{ 'border-red-500': form.errors.company_name, 'border-green-500': form.company_name && !form.errors.company_name }"
              required
              @input="validateCompanyName"
              @blur="validateCompanyName"
              autocomplete="off"
              spellcheck="false"
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
              :class="{ 'border-red-500': form.errors.phone, 'border-green-500': form.phone && !form.errors.phone }"
              required
              placeholder="(99) 99999-9999"
              @input="formatPhone"
              @blur="validatePhone"
              autocomplete="off"
              spellcheck="false"
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
              :class="{ 'border-red-500': form.errors.password, 'border-green-500': form.password && !form.errors.password && allPasswordChecksPass }"
              required
              @input="validatePassword"
              @blur="validatePassword"
              autocomplete="new-password"
            >
            <div v-if="form.errors.password" class="text-red-500 text-xs mt-1">
              {{ form.errors.password }}
            </div>
            <!-- Requisitos da senha -->
            <div class="mt-2 text-xs text-gray-600">
              <p>A senha deve conter:</p>
              <ul class="list-disc list-inside">
                <li :class="{ 'text-green-600': passwordChecks.length }">Mínimo de 8 caracteres</li>
                <li :class="{ 'text-green-600': passwordChecks.uppercase }">Pelo menos uma letra maiúscula</li>
                <li :class="{ 'text-green-600': passwordChecks.lowercase }">Pelo menos uma letra minúscula</li>
                <li :class="{ 'text-green-600': passwordChecks.number }">Pelo menos um número</li>
                <li :class="{ 'text-green-600': passwordChecks.special }">Pelo menos um caractere especial</li>
              </ul>
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
              :class="{ 
                'border-red-500': !passwordsMatch && form.password_confirmation,
                'border-green-500': passwordsMatch && form.password_confirmation
              }"
              required
              @input="validatePasswordConfirmation"
              @blur="validatePasswordConfirmation"
              autocomplete="new-password"
            >
            <div v-if="!passwordsMatch && form.password_confirmation" class="text-red-500 text-xs mt-1">
              As senhas não correspondem
            </div>
          </div>

          <!-- Botão de Submit -->
          <div class="flex items-center justify-between">
            <button
              type="submit"
              class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline disabled:opacity-50 disabled:cursor-not-allowed"
              :disabled="!isFormValid || form.processing || isCheckingEmail"
            >
              <span v-if="form.processing">Registrando...</span>
              <span v-else-if="isCheckingEmail">Verificando...</span>
              <span v-else>Registrar</span>
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

    <!-- Success Modal -->
    <SuccessModal
      :show="showSuccessModal"
      @confirm="handleModalConfirm"
    />
  </GuestLayout>
</template>

<script setup>
import { useForm, Link, router } from '@inertiajs/vue3'
import { ref, computed, onMounted } from 'vue'
import GuestLayout from '@/Layouts/GuestLayout.vue'
import SuccessModal from '@/Components/SuccessModal.vue'
import debounce from 'lodash/debounce'

const showSuccessModal = ref(false)
const isCheckingEmail = ref(false)

onMounted(() => {
  const urlParams = new URLSearchParams(window.location.search)
  if (urlParams.get('success') === 'true') {
    showSuccessModal.value = true
  }
})

const form = useForm({
  name: '',
  email: '',
  company_name: '',
  phone: '',
  password: '',
  password_confirmation: '',
})

const passwordChecks = ref({
  length: false,
  uppercase: false,
  lowercase: false,
  number: false,
  special: false
})

const allPasswordChecksPass = computed(() => {
  return Object.values(passwordChecks.value).every(check => check)
})

const passwordsMatch = computed(() => {
  return !form.password_confirmation || form.password === form.password_confirmation
})

const isFormValid = computed(() => {
  return form.name &&
    form.email &&
    form.company_name &&
    form.phone &&
    form.password &&
    form.password_confirmation &&
    passwordsMatch.value &&
    allPasswordChecksPass.value &&
    !form.errors.email &&
    !form.errors.name &&
    !form.errors.company_name &&
    !form.errors.phone &&
    !form.errors.password &&
    !isCheckingEmail.value
})

const validateName = () => {
  if (!form.name) {
    form.errors.name = 'O nome é obrigatório'
  } else if (form.name.length < 3) {
    form.errors.name = 'O nome deve ter pelo menos 3 caracteres'
  } else {
    delete form.errors.name
  }
}

const validateEmail = () => {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
  if (!form.email) {
    form.errors.email = 'O e-mail é obrigatório'
  } else if (!emailRegex.test(form.email)) {
    form.errors.email = 'Digite um e-mail válido'
  } else {
    delete form.errors.email
    checkEmailAvailability()
  }
}

const checkEmailAvailability = debounce(async () => {
  if (!form.email || form.errors.email) return

  isCheckingEmail.value = true
  try {
    const response = await fetch(route('check-email', { email: form.email }))
    const data = await response.json()
    
    if (data.exists) {
      form.errors.email = 'Este e-mail já está em uso'
    }
  } catch (error) {
    console.error('Erro ao verificar e-mail:', error)
  } finally {
    isCheckingEmail.value = false
  }
}, 500)

const validateCompanyName = () => {
  if (!form.company_name) {
    form.errors.company_name = 'O nome da empresa é obrigatório'
  } else if (form.company_name.length < 2) {
    form.errors.company_name = 'O nome da empresa deve ter pelo menos 2 caracteres'
  } else {
    delete form.errors.company_name
  }
}

const formatPhone = () => {
  let phone = form.phone.replace(/\D/g, '')
  if (phone.length <= 11) {
    phone = phone.replace(/^(\d{2})(\d{4,5})(\d{4}).*/, '($1) $2-$3')
    form.phone = phone
  }
  validatePhone()
}

const validatePhone = () => {
  if (!form.phone) {
    form.errors.phone = 'O telefone é obrigatório'
    return
  }
  
  const phoneRegex = /^\([0-9]{2}\)\s[0-9]{4,5}-[0-9]{4}$/
  if (!phoneRegex.test(form.phone)) {
    form.errors.phone = 'Digite um telefone válido no formato (99) 99999-9999'
  } else {
    delete form.errors.phone
  }
}

const validatePassword = () => {
  const password = form.password
  
  passwordChecks.value = {
    length: password.length >= 8,
    uppercase: /[A-Z]/.test(password),
    lowercase: /[a-z]/.test(password),
    number: /[0-9]/.test(password),
    special: /[!@#$%^&*]/.test(password)
  }

  if (!password) {
    form.errors.password = 'A senha é obrigatória'
  } else if (!Object.values(passwordChecks.value).every(check => check)) {
    form.errors.password = 'A senha não atende aos requisitos mínimos'
  } else {
    delete form.errors.password
  }

  validatePasswordConfirmation()
}

const validatePasswordConfirmation = () => {
  if (!form.password_confirmation) {
    form.errors.password_confirmation = 'A confirmação de senha é obrigatória'
  } else if (!passwordsMatch.value) {
    form.errors.password_confirmation = 'As senhas não correspondem'
  } else {
    delete form.errors.password_confirmation
  }
}

const submit = () => {
  if (!isFormValid.value) {
    return
  }

  form.post(route('register'), {
    preserveScroll: true,
    onError: (errors) => {
      console.error('Erros no registro:', errors)
      if (errors.error) {
        form.setError('error', errors.error)
      }
    }
  })
}

const handleModalConfirm = () => {
  showSuccessModal.value = false
  router.visit(route('home'))
}
</script>

<style scoped>
input:-webkit-autofill,
input:-webkit-autofill:hover,
input:-webkit-autofill:focus,
input:-webkit-autofill:active {
    transition: background-color 5000s ease-in-out 0s;
    -webkit-text-fill-color: #374151 !important;
}
</style> 