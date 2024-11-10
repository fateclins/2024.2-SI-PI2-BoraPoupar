<script setup>
import AuthLayout from '@/layouts/AuthLayout.vue';
import { Button } from 'primevue';
import { useRouter } from 'vue-router';

const router = useRouter();
</script>

<template>
  <AuthLayout>
    <Button @click="router.push('/transactions/create')"
    class="!absolute !right-2 !bottom-24 !w-14 !h-14"
    icon="pi pi-plus" rounded aria-label="Nova transaction" />

    
  </AuthLayout>
</template>