<script setup>
import { Card } from 'primevue';
import CardContent from './Card/CardContent.vue';
import CardFooter from './Card/CardFooter.vue';
defineProps(['saving'])
</script>
<template>
  <Card class="mt-2">
    <template #content>
      <CardContent :saving />
    </template>

    <template #footer>
        <CardFooter :saving />
    </template>
  </Card>
</template>
