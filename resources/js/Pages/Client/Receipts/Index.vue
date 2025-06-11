<template>
  <AuthenticatedLayout>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
      <div class="p-6 text-gray-900">
        <h2 class="text-2xl font-semibold mb-6">Meus Comprovantes</h2>
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Nº do Comprovante
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Data
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Serviço
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Valor
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Status
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Ações
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-if="receipts.length === 0">
                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                  Nenhum comprovante encontrado
                </td>
              </tr>
              <tr v-for="receipt in receipts" :key="receipt.id" class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                  {{ receipt.number }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  {{ receipt.date }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  {{ receipt.service }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                  {{ receipt.value }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span :class="[
                    'px-2 inline-flex text-xs leading-5 font-semibold rounded-full',
                    {
                      'bg-green-100 text-green-800': receipt.status === 'paid',
                      'bg-yellow-100 text-yellow-800': receipt.status === 'pending',
                      'bg-red-100 text-red-800': receipt.status === 'overdue'
                    }
                  ]">
                    {{ receipt.status }}
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                  <button class="text-blue-600 hover:text-blue-900 mr-3">
                    <i class="fas fa-eye"></i>
                  </button>
                  <button class="text-blue-600 hover:text-blue-900">
                    <i class="fas fa-download"></i>
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
const receipts = [
  {
    id: 1,
    number: 'REC-2024-001',
    date: '2024-03-15',
    service: 'Manutenção Notebook',
    value: 'R$ 350,00',
    status: 'paid'
  },
  {
    id: 2,
    number: 'REC-2024-002',
    date: '2024-03-14',
    service: 'Reparo Impressora',
    value: 'R$ 180,00',
    status: 'pending'
  }
]
</script> 