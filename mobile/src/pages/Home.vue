<script setup>
import AuthLayout from '@/layouts/AuthLayout.vue';
import MonthResume from '@/components/Home/MonthResume.vue';
import RecentTransactions from '@/components/Home/RecentTransactions.vue';
import HomeHeader from '@/components/Home/HomeHeader.vue';
</script>

<template>
  <AuthLayout>
    <template #header>
      <HomeHeader />
    </template>

    <MonthResume />
    <RecentTransactions />
    
  </AuthLayout>
</template>