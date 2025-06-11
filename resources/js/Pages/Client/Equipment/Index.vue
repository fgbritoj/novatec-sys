<template>
  <AuthenticatedLayout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class="p-6 text-gray-900">
        <h2 class="text-2xl font-semibold mb-6">Meus Equipamentos</h2>
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Tipo
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Marca/Modelo
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Nº de Série
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Status
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Última Manutenção
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Ações
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-if="equipment.length === 0">
                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                  Nenhum equipamento encontrado
                </td>
              </tr>
              <tr v-for="item in equipment" :key="item.id" class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                  {{ item.type }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  {{ item.model }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  {{ item.serial }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span :class="[
                    'px-2 inline-flex text-xs leading-5 font-semibold rounded-full',
                    {
                      'bg-green-100 text-green-800': item.status === 'active',
                      'bg-yellow-100 text-yellow-800': item.status === 'maintenance',
                      'bg-red-100 text-red-800': item.status === 'inactive'
                    }
                  ]">
                    {{ item.status }}
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  {{ item.lastMaintenance }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                  <button class="text-blue-600 hover:text-blue-900 mr-3">
                    <i class="fas fa-eye"></i>
                  </button>
                  <button class="text-blue-600 hover:text-blue-900">
                    <i class="fas fa-history"></i>
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

// Mock data - substituir por dados reais da API
const equipment = [
  {
    id: 1,
    type: 'Notebook',
    model: 'Dell Inspiron 15',
    serial: 'DLL123456',
    status: 'active',
    lastMaintenance: '2024-02-15'
  },
  {
    id: 2,
    type: 'Impressora',
    model: 'HP LaserJet Pro',
    serial: 'HP789012',
    status: 'maintenance',
    lastMaintenance: '2024-03-10'
  }
]
</script> 