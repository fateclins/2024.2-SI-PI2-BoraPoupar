<script setup>
import DailyReport from '@/components/Reports/DailyReport.vue';
import MonthlyReport from '@/components/Reports/MonthlyReport.vue';
import Header from '@/components/Reports/Header.vue';
import LoadingState from '@/components/Transactions/ListTransaction/LoadingState.vue';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { useTransactionStore } from '@/stores/TransactionStore';
import { computed, onMounted, ref } from 'vue';

const transactionStore = useTransactionStore();
const transactions = computed(() => transactionStore.transactions);
const loading = ref(false);

onMounted(async () => {
  loading.value = true;
  await transactionStore.getTransactions();
  loading.value = false;
});
</script>

<template>
  <AuthLayout>
    <Header />

    <template v-if="loading">
      <LoadingState />
    </template>

    <template v-else>
      <div class="mt-4 flex gap-4 flex-col">
        <p class="text-gray-700">
          Resumo Diário:
        </p>

        <DailyReport :transactions />
      </div>

      <div class="mt-4 flex gap-4 flex-col">
        <p class="text-gray-700">
          Resumo Mensal:
        </p>

        <MonthlyReport :transactions />
      </div>
    </template>
  </AuthLayout>
</template>