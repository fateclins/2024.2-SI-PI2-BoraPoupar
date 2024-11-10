<script setup>
import {
  IonFooter,
  IonToolbar,
} from '@ionic/vue';

import { Button } from 'primevue';
import { useRoute, useRouter } from 'vue-router';

const route = useRoute();
const router = useRouter();

const goTo = (path) => {
  if (route.path === path) return;
  router.push(path);
}
</script>

<template>
  <IonFooter class="!border-none">
    <IonToolbar class="!border-none">
      <div class="flex py-2 justify-around">

        <Button variant="text" rounded icon="pi pi-home" iconPos="top"
          :class="{ '!text-green-500': route.path === '/home', '!text-gray-800': route.path !== '/' }"
          @click="goTo('/home')" />

        <Button variant="text" rounded icon="pi pi-money-bill" iconPos="top"
          :class="{ '!text-green-500': route.path === '/transactions', '!text-gray-800': route.path !== '/transactions' }"
          @click="goTo('/transactions')" />

        <Button variant="text" rounded icon="pi pi-wallet" iconPos="top"
          :class="{ '!text-green-500': route.path === '/savings', '!text-gray-800': route.path !== '/savings' }"
          @click="goTo('/savings')" />

        <Button variant="text" rounded icon="pi pi-chart-bar" iconPos="top"
          :class="{ '!text-green-500': route.path === '/reports', '!text-gray-800': route.path !== '/reports' }"
          @click="goTo('/reports')" />
      </div>
    </IonToolbar>
  </IonFooter>
</template>