<script setup>
import BaseWidget from './Widgets/BaseWidget.vue';

defineProps(['showBalance']);
</script>
<template>
  <div class="flex justify-between gap-4 mt-4">
    <BaseWidget :showBalance value="6500.00" type="income" />
    <BaseWidget :showBalance value="650.00" type="expense" />
  </div>
</template>