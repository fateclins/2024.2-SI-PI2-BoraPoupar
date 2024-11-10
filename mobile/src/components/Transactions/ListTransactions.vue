<script setup>
import { useTransactionStore } from '@/stores/TransactionStore';
import { computed, onMounted, ref } from 'vue';
import EmptyState from './ListTransaction/EmptyState.vue';
import LoadingState from './ListTransaction/LoadingState.vue';
import TransactionCard from './ListTransaction/TransactionCard.vue';
import Header from './ListTransaction/Header.vue';
import { onBeforeRouteUpdate } from 'vue-router';

const useTransaction = useTransactionStore();
const transactions = computed(() => useTransaction.transactions);
const filteredTransactions = ref([]);
const loading = ref(false);

const fetchTransactions = async () => {
  loading.value = true;
  await useTransaction.getTransactions();
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
      <Header @update:selectedType="filter($event)" :nmt="true" />

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