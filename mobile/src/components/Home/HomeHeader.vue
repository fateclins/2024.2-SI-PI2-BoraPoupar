<script setup>
import { IonHeader } from '@ionic/vue';
import { Button, Avatar } from 'primevue';
import { useUserStore } from '@/stores/UserStore';
import UserInfo from './Header/UserInfo.vue';

const userStore = useUserStore();

const firstName = userStore.firstName;

const toggleShowBalance = async () => {
  await userStore.toggleShowBalance();
}
</script>

<template>
  <div class="">
    <div class="flex items-center justify-between">
      <div class="flex items-center gap-2">
        <UserInfo :firstName="firstName" />
      </div>
      <div class="flex">
        <Button @click="toggleShowBalance"
            icon="pi pi-eye" variant="text" rounded aria-label="Esconder valores" />
            
        <Button icon="pi pi-bell" variant="text" rounded aria-label="Notificações" />
      </div>
    </div>
  </div>
</template>

<style scoped></style>