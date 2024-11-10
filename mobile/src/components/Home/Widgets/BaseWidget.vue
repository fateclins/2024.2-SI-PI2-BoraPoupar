<script setup>
import { ref } from 'vue';

defineProps(['value', 'type', 'showBalance']);

const incomeIconBg = ref('bg-green-300');
const expenseIconBg = ref('bg-red-300');

const incomeIconColor = ref('text-green-600');
const expenseIconColor = ref('text-red-600');

</script>
<template>
  <div class="bg-white p-2 flex gap-4 rounded-md w-full items-center">
    <div class="p-2 flex items-center justify-center rounded-md w-10 h-10" :class="type === 'expense' ? expenseIconBg : incomeIconBg">
      <span class="pi pi-dollar" :class="type === 'expense' ? expenseIconColor : incomeIconColor"></span>
    </div>
    <div class="flex flex-col">
      <p class="text-gray-700">
        {{ type === 'expense' ? 'Despesas' : 'Receitas' }}
      </p>

      <p class="text-gray-800 font-bold">
        R$ {{ showBalance ? value : '---' }}
      </p>
    </div>
  </div>
</template>