<script setup>
import { computed, onMounted } from 'vue';
import Widgets from './Widgets.vue';
import { useUserStore } from '@/stores/UserStore';

const userStore = useUserStore();

const showBalance = computed(() => userStore.showBalance);

const incomes = computed(() => userStore.monthIncome);
const expenses = computed(() => userStore.monthExpense);

onMounted(() => {
  userStore.getMonthResume();
});
</script>

<template>
  <div>
    <div class="flex justify-between mt-4">
      <p class="text-gray-700">
        resumo de <span class="text-gray-800 font-bold">{{ new Date().toLocaleString('default', { month: 'long' }) }}</span> 
      </p>

      <p>
        <span class="text-gray-800 font-bold">
          R$ {{ showBalance ? userStore.balance : '---' }}
        </span>
      </p>
    </div>

    <Widgets :showBalance 
      :incomes
      :expenses
    />
  </div>
</template>