<script setup>
import { useRouter } from 'vue-router';
import AuthLayout from '@/layouts/AuthLayout.vue';
import ListTransactions from '@/components/Transactions/ListTransactions.vue';
import { Button } from 'primevue';

const router = useRouter();

</script>

<template>
  <AuthLayout>
    <Button @click="router.push('/transactions/create')" class="!fixed !right-2 !bottom-24 !w-14 !h-14 !z-50"
      icon="pi pi-plus" rounded aria-label="Nova transaction" />

    <ListTransactions />
  </AuthLayout>
</template>