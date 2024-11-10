<script setup>
import AuthLayout from '@/layouts/AuthLayout.vue';
import MonthResume from '@/components/Home/MonthResume.vue';
import RecentTransactions from '@/components/Home/RecentTransactions.vue';
import HomeHeader from '@/components/Home/HomeHeader.vue';
import { Button } from 'primevue';
import { useRouter } from 'vue-router';

const router = useRouter();
</script>

<template>
  <AuthLayout>
    <template #header>
      <HomeHeader />
    </template>

    <MonthResume />
    <RecentTransactions />

    <Button @click="router.push('/transactions/create')" class="!fixed !right-2 !bottom-24 !w-14 !h-14 !z-50"
        icon="pi pi-plus" rounded aria-label="Nova Transação" />
    
  </AuthLayout>
</template>