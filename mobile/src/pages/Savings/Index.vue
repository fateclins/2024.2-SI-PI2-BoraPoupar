<script setup>
import { computed, ref } from 'vue';
import AuthLayout from '@/layouts/AuthLayout.vue';
import Header from '@/components/Savings/Header.vue';
import LoadingState from '@/components/Transactions/ListTransaction/LoadingState.vue';
import ListSavings from '@/components/Savings/ListSavings.vue';
import { Button } from 'primevue';
import { useRouter } from 'vue-router';
import {useSavingStore} from '@/stores/SavingStore';
import Modal from '@/components/Savings/ListSavings/Modal.vue';

const loading = ref(false);
const router = useRouter();
const useSaving = useSavingStore();

</script>

<template>
  <AuthLayout>
    <Header />

    <template v-if="loading">
      <LoadingState />
    </template>

    <template v-else>
      <Button @click="router.push('/savings/create')" class="!fixed !right-2 !bottom-24 !w-14 !h-14 !z-50"
        icon="pi pi-plus" rounded aria-label="Nova Caixinha" />

      <ListSavings />

      <Modal />

    </template>
  </AuthLayout>
</template>