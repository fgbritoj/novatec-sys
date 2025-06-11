<template>
  <GuestLayout>
    <!-- Hero Section -->
    <section id="home" class="relative">
      <div class="swiper hero-swiper">
        <div class="swiper-wrapper">
          <!-- Slide 1 -->
          <div class="swiper-slide relative h-[600px]">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-600/90 to-blue-800/90">
              <img src="/images/banners/banner1.jpg" alt="Gestão de Assistência Técnica" class="w-full h-full object-cover object-center absolute inset-0 -z-10">
            </div>
            <div class="container mx-auto px-4 h-full flex items-center justify-center">
              <div class="text-center text-white max-w-4xl relative z-10">
                <h1 class="text-4xl md:text-6xl font-bold mb-4">
                  Gestão Completa para sua Assistência Técnica
                </h1>
                <p class="text-xl mb-8">
                  Sistema integrado para controle de orçamentos, clientes e serviços
                </p>
                <Link :href="route('register')" class="inline-block bg-white text-blue-600 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition">
                  Comece Agora
                </Link>
              </div>
            </div>
          </div>

          <!-- Slide 2 -->
          <div class="swiper-slide relative h-[600px]">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-800/90 to-blue-600/90">
              <img src="/images/banners/banner2.jpg" alt="Controle de Orçamentos" class="w-full h-full object-cover object-center absolute inset-0 -z-10">
            </div>
            <div class="container mx-auto px-4 h-full flex items-center justify-center">
              <div class="text-center text-white max-w-4xl relative z-10">
                <h1 class="text-4xl md:text-6xl font-bold mb-4">
                  Controle Total de Orçamentos
                </h1>
                <p class="text-xl mb-8">
                  Crie e gerencie orçamentos profissionais em minutos
                </p>
                <Link :href="route('register')" class="inline-block bg-white text-blue-600 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition">
                  Comece Agora
                </Link>
              </div>
            </div>
          </div>

          <!-- Slide 3 -->
          <div class="swiper-slide relative h-[600px]">
            <div class="absolute inset-0 bg-gradient-to-r from-blue-600/90 to-blue-800/90">
              <img src="/images/banners/banner3.jpg" alt="Gestão de Clientes" class="w-full h-full object-cover object-center absolute inset-0 -z-10">
            </div>
            <div class="container mx-auto px-4 h-full flex items-center justify-center">
              <div class="text-center text-white max-w-4xl relative z-10">
                <h1 class="text-4xl md:text-6xl font-bold mb-4">
                  Gestão Eficiente de Clientes
                </h1>
                <p class="text-xl mb-8">
                  Mantenha todo o histórico e informações em um só lugar
                </p>
                <Link :href="route('register')" class="inline-block bg-white text-blue-600 px-8 py-3 rounded-full font-semibold hover:bg-gray-100 transition">
                  Comece Agora
                </Link>
              </div>
            </div>
          </div>
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
      </div>
    </section>

    <!-- Features Section -->
    <section id="servicos" class="py-20 bg-white">
      <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Nossas Funcionalidades</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          <div v-for="feature in features" :key="feature.id" 
               class="bg-white rounded-lg shadow-lg p-6 transform hover:scale-105 transition-transform duration-300">
            <div class="text-4xl text-blue-600 mb-4">
              <i :class="feature.icon"></i>
            </div>
            <h3 class="text-xl font-semibold mb-2">{{ feature.title }}</h3>
            <p class="text-gray-600">{{ feature.description }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- About Section -->
    <section id="sobre" class="py-20 bg-gray-50">
      <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
          <h2 class="text-3xl md:text-4xl font-bold text-center mb-8">Sobre a NovaTec</h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <div>
              <img src="/images/logo-branca.png" alt="NovaTec Logo" class="rounded-lg shadow-lg w-full h-auto">
            </div>
            <div>
              <p class="text-gray-600 mb-4">
                A NovaTec é uma empresa especializada em assistência técnica de informática, 
                oferecendo soluções completas para manutenção e reparo de equipamentos.
              </p>
              <p class="text-gray-600 mb-4">
                Com mais de X anos de experiência no mercado, nossa equipe altamente qualificada 
                está preparada para atender todas as suas necessidades em tecnologia.
              </p>
              <div class="grid grid-cols-2 gap-4 mt-8">
                <div class="text-center transform hover:scale-105 transition-transform duration-300">
                  <div class="text-3xl font-bold text-blue-600">
                    <span class="counter" ref="clientesCounter">0</span>+
                  </div>
                  <div class="text-gray-500">Clientes Atendidos</div>
                </div>
                <div class="text-center transform hover:scale-105 transition-transform duration-300">
                  <div class="text-3xl font-bold text-blue-600">
                    <span class="counter" ref="satisfacaoCounter">0</span>%
                  </div>
                  <div class="text-gray-500">Satisfação</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Contact Section -->
    <section id="contato" class="py-20 bg-white">
      <div class="container mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-bold text-center mb-12">Entre em Contato</h2>
        <div class="max-w-4xl mx-auto">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
              <h3 class="text-xl font-semibold mb-4">Informações de Contato</h3>
              <div class="space-y-4">
                <div class="flex items-center">
                  <i class="fas fa-map-marker-alt text-blue-600 text-xl w-8"></i>
                  <span class="text-gray-600">Endereço da NovaTec</span>
                </div>
                <div class="flex items-center">
                  <i class="fas fa-phone text-blue-600 text-xl w-8"></i>
                  <span class="text-gray-600">(XX) XXXX-XXXX</span>
                </div>
                <div class="flex items-center">
                  <i class="fas fa-envelope text-blue-600 text-xl w-8"></i>
                  <span class="text-gray-600">contato@novatec.com</span>
                </div>
                <div class="flex items-center">
                  <i class="fas fa-clock text-blue-600 text-xl w-8"></i>
                  <span class="text-gray-600">Seg - Sex: 9h às 18h</span>
                </div>
              </div>
              <div class="mt-8">
                <h3 class="text-xl font-semibold mb-4">Redes Sociais</h3>
                <div class="flex space-x-4">
                  <a href="#" class="text-blue-600 hover:text-blue-700">
                    <i class="fab fa-facebook text-2xl"></i>
                  </a>
                  <a href="#" class="text-blue-600 hover:text-blue-700">
                    <i class="fab fa-instagram text-2xl"></i>
                  </a>
                  <a href="#" class="text-blue-600 hover:text-blue-700">
                    <i class="fab fa-whatsapp text-2xl"></i>
                  </a>
                </div>
              </div>
            </div>
            <div>
              <form @submit.prevent="submitContact" class="space-y-6">
                <div>
                  <label class="block text-gray-700 mb-2" for="name">Nome</label>
                  <input 
                    type="text" 
                    id="name" 
                    v-model="form.name"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                    required
                  >
                </div>
                <div>
                  <label class="block text-gray-700 mb-2" for="email">E-mail</label>
                  <input 
                    type="email" 
                    id="email" 
                    v-model="form.email"
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                    required
                  >
                </div>
                <div>
                  <label class="block text-gray-700 mb-2" for="message">Mensagem</label>
                  <textarea 
                    id="message" 
                    v-model="form.message"
                    rows="4" 
                    class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                    required
                  ></textarea>
                </div>
                <button 
                  type="submit" 
                  class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition"
                  :disabled="form.processing"
                >
                  {{ form.processing ? 'Enviando...' : 'Enviar Mensagem' }}
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </GuestLayout>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import { useForm, Link, usePage } from '@inertiajs/vue3'
import GuestLayout from '@/Layouts/GuestLayout.vue'
import Swiper from 'swiper'
import { Pagination, Navigation, Autoplay } from 'swiper/modules'

// Import Swiper styles
import 'swiper/css'
import 'swiper/css/navigation'
import 'swiper/css/pagination'

const features = [
  {
    id: 1,
    icon: 'fas fa-file-invoice',
    title: 'Orçamentos',
    description: 'Crie e gerencie orçamentos de forma rápida e profissional'
  },
  {
    id: 2,
    icon: 'fas fa-users',
    title: 'Clientes',
    description: 'Cadastro completo de clientes com histórico de serviços'
  },
  {
    id: 3,
    icon: 'fas fa-laptop',
    title: 'Equipamentos',
    description: 'Controle de equipamentos e histórico de manutenções'
  },
  {
    id: 4,
    icon: 'fas fa-calendar-alt',
    title: 'Agendamentos',
    description: 'Sistema de agendamento de serviços e controle de horários'
  },
  {
    id: 5,
    icon: 'fas fa-chart-line',
    title: 'Relatórios',
    description: 'Relatórios detalhados de vendas, serviços e desempenho'
  },
  {
    id: 6,
    icon: 'fas fa-mobile-alt',
    title: 'Notificações',
    description: 'Sistema de notificações para clientes e equipe técnica'
  }
]

const form = useForm({
  name: '',
  email: '',
  message: ''
})

const submitContact = () => {
  form.post(route('contact.submit'), {
    onSuccess: () => {
      form.reset()
    }
  })
}

const clientesCounter = ref(null)
const satisfacaoCounter = ref(null)

const animateValue = (element, start, end, duration) => {
  if (!element) return
  
  let startTimestamp = null
  const step = (timestamp) => {
    if (!startTimestamp) startTimestamp = timestamp
    const progress = Math.min((timestamp - startTimestamp) / duration, 1)
    const value = Math.floor(progress * (end - start) + start)
    element.textContent = value
    if (progress < 1) {
      window.requestAnimationFrame(step)
    }
  }
  window.requestAnimationFrame(step)
}

const startCounterAnimation = () => {
  if (clientesCounter.value) {
    animateValue(clientesCounter.value, 0, 1000, 2000)
  }
  if (satisfacaoCounter.value) {
    animateValue(satisfacaoCounter.value, 0, 98, 2000)
  }
}

onMounted(() => {
  setTimeout(() => {
    new Swiper('.hero-swiper', {
      modules: [Pagination, Navigation, Autoplay],
      slidesPerView: 1,
      spaceBetween: 0,
      loop: true,
      autoplay: {
        delay: 5000,
        disableOnInteraction: false,
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    })
  }, 100) // Small delay to ensure DOM is ready

  // Add Intersection Observer for counter animation
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        startCounterAnimation()
        observer.unobserve(entry.target)
      }
    })
  }, { threshold: 0.5 })

  const aboutSection = document.getElementById('sobre')
  if (aboutSection) {
    observer.observe(aboutSection)
  }
})
</script>

<style>
.hero-swiper {
  width: 100%;
  height: 600px;
}

.hero-swiper .swiper-button-next,
.hero-swiper .swiper-button-prev {
  color: white;
}

.hero-swiper .swiper-pagination-bullet {
  background: white;
  opacity: 0.5;
}

.hero-swiper .swiper-pagination-bullet-active {
  opacity: 1;
}

.hero-swiper .swiper-slide {
  position: relative;
}
</style> 