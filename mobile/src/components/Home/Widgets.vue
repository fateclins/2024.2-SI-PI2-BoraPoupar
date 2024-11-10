<script setup>
import BaseWidget from './Widgets/BaseWidget.vue';

defineProps(['showBalance', 'incomes', 'expenses']);


</script>
<template>
  <div class="flex justify-between gap-4 mt-4">
    <BaseWidget :showBalance :value="incomes" type="income" />
    <BaseWidget :showBalance :value="expenses" type="expense" />
  </div>
</template>