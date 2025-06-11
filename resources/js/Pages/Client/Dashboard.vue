<template>
  <AuthenticatedLayout>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
          <!-- Quick Stats -->
          <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
              <div class="flex items-center">
                <div class="flex-shrink-0">
                  <i class="fas fa-file-invoice text-blue-600 text-3xl"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                  <dl>
                    <dt class="text-sm font-medium text-gray-500 truncate">
                      Orçamentos Ativos
                    </dt>
                    <dd class="text-3xl font-semibold text-gray-900">
                      {{ stats.activeQuotes }}
                    </dd>
                  </dl>
                </div>
              </div>
            </div>
          </div>

          <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
              <div class="flex items-center">
                <div class="flex-shrink-0">
                  <i class="fas fa-laptop text-blue-600 text-3xl"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                  <dl>
                    <dt class="text-sm font-medium text-gray-500 truncate">
                      Equipamentos
                    </dt>
                    <dd class="text-3xl font-semibold text-gray-900">
                      {{ stats.equipmentCount }}
                    </dd>
                  </dl>
                </div>
              </div>
            </div>
          </div>

          <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
              <div class="flex items-center">
                <div class="flex-shrink-0">
                  <i class="fas fa-receipt text-blue-600 text-3xl"></i>
                </div>
                <div class="ml-5 w-0 flex-1">
                  <dl>
                    <dt class="text-sm font-medium text-gray-500 truncate">
                      Recibos
                    </dt>
                    <dd class="text-3xl font-semibold text-gray-900">
                      {{ stats.receiptCount }}
                    </dd>
                  </dl>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Recent Activity -->
        <div class="mt-8">
          <h2 class="text-lg font-medium text-gray-900">Atividade Recente</h2>
          <div class="mt-4 bg-white shadow rounded-lg">
            <div class="p-6">
              <div v-if="recentActivity.length > 0">
                <div v-for="activity in recentActivity" :key="activity.id" class="mb-4 last:mb-0">
                  <div class="flex items-center">
                    <div class="flex-shrink-0">
                      <i :class="activity.icon" class="text-blue-600"></i>
                    </div>
                    <div class="ml-4">
                      <p class="text-sm font-medium text-gray-900">{{ activity.description }}</p>
                      <p class="text-sm text-gray-500">{{ activity.date }}</p>
                    </div>
                  </div>
                </div>
              </div>
              <p v-else class="text-gray-500 text-center">Nenhuma atividade recente.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { defineProps } from 'vue'

const props = defineProps({
  stats: {
    type: Object,
    default: () => ({
      activeQuotes: 0,
      equipmentCount: 0,
      receiptCount: 0
    })
  },
  recentActivity: {
    type: Array,
    default: () => []
  }
})
</script> 