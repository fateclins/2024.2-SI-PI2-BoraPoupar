<script setup>
import { Card } from 'primevue';
import CardContent from './Card/CardContent.vue';
import CardFooter from './Card/CardFooter.vue';
defineProps(['transaction'])
</script>
<template>
  <Card class="mt-2">
    <template #content>
      <CardContent :transaction="transaction" />
    </template>

    <template #footer>
        <CardFooter :transaction="transaction" />
    </template>
  </Card>
</template>
