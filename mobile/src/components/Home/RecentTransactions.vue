<script setup>
import { useTransactionStore } from '@/stores/TransactionStore';
import { computed, onMounted, ref } from 'vue';
import EmptyState from '@/components/Transactions/ListTransaction/EmptyState.vue';
import LoadingState from '@/components/Transactions/ListTransaction/LoadingState.vue';
import TransactionCard from '@/components/Transactions/ListTransaction/TransactionCard.vue';
import Header from '@/components/Transactions/ListTransaction/Header.vue';
import { onBeforeRouteUpdate } from 'vue-router';

const useTransaction = useTransactionStore();
const transactions = computed(() => useTransaction.recentTransactions);
const filteredTransactions = ref([]);
const loading = ref(false);

const fetchTransactions = async () => {
  loading.value = true;
  await useTransaction.getRecentTransactions();
  filteredTransactions.value = transactions.value;
  loading.value = false;
};

const filter = (event) => {
  if (!event.value) {
    filteredTransactions.value = transactions.value;
    return;
  }

  loading.value = true;
  filteredTransactions.value = transactions.value.filter((transaction) => transaction.type === event.value);
  loading.value = false;
};

onMounted(fetchTransactions);

onBeforeRouteUpdate((to, from, next) => {
  fetchTransactions();
  next();
});

</script>
<template>
  <div class="mt-12">
    <template v-if="loading">
      <LoadingState />
    </template>

    <template v-else>
      <Header @update:selectedType="filter($event)" />

      <EmptyState v-if="filteredTransactions.length === 0" />

      <template v-else>
        <ul>
          <li v-for="transaction in filteredTransactions" :key="transaction.id">
            <TransactionCard :transaction="transaction" />
          </li>
        </ul>
      </template>
    </template>
  </div>
</template>