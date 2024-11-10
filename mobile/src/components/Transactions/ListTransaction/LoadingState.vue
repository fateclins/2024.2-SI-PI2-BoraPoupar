<script setup>
import { ProgressSpinner } from 'primevue';
</script>
<template>
  <div class="flex justify-center items-center h-full w-full">
    <ProgressSpinner style="width: 50px; height: 50px; color: #10b981 !important;" strokeWidth="8" fill="transparent"
  animationDuration=".5s" aria-label="Carregando..." />
  </div>
</template>