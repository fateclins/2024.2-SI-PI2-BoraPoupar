<script setup>
import { Avatar } from 'primevue';

defineProps(['firstName']);
</script>
<template>
  <div class="flex items-center gap-2">
    <Avatar icon="pi pi-user" style="background-color: #dee9fc; color: #1a2551" shape="circle" />
    <div class="">
      <p class="text-sm font-semibold">
        Olá,
      </p>
      <p class="text-xs text-gray-500">
        {{ firstName }}
      </p>
    </div>
  </div>
</template>