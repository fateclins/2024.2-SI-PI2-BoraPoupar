<script setup>
import { useSavingStore } from '@/stores/SavingStore';
import { computed, onMounted, ref } from 'vue';
import EmptyState from './ListSavings/EmptyState.vue';
import LoadingState from '@/components/Transactions/ListTransaction/LoadingState.vue';
import SavingCard from './ListSavings/SavingCard.vue';
import { onBeforeRouteUpdate } from 'vue-router';

const useSaving = useSavingStore();
const savings = computed(() => useSaving.savings);
const loading = ref(false);

const fetchSavings = async () => {
  loading.value = true;
  await useSaving.getSavings();
  loading.value = false;
};

onMounted(fetchSavings);

onBeforeRouteUpdate((to, from, next) => {
  fetchSavings();
  next();
});

</script>
<template>
  <div class="mt-12">
    <template v-if="loading">
      <LoadingState />
    </template>

    <template v-else>
      <EmptyState v-if="savings.length === 0" />

      <template v-else>
        <ul>
          <li v-for="saving in savings" :key="saving.id">
            <SavingCard :saving />
          </li>
        </ul>
      </template>
    </template>
  </div>
</template>