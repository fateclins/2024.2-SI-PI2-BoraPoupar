<script setup>
import { Select } from 'primevue';
import { ref, watch } from 'vue';

const selectedType = ref(null);

const emit = defineEmits(['update:selectedType']);
const props = defineProps(['nmt'])

const options = [
  { label: 'Todas', value: null },
  { label: 'Receitas', value: 'income' },
  { label: 'Despesas', value: 'expense' },
];

watch(selectedType, (value) => {
  emit('update:selectedType', value);
});
</script>
<template>
  <div class="flex items-center justify-between" :class="{
    '-mt-8': nmt,
    'mt-8': !nmt,
  }">
    <h2 class="text-2xl font-bold">
      {{ nmt ? 'Transações' : 'Transações Recentes' }}
    </h2>

    <Select :options="options" v-model="selectedType" option-label="label" class="ml-4" />
  </div>
</template>
