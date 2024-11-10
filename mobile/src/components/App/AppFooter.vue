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
      <div class="flex gap-4">

        <Button label="Início" variant="text" rounded icon="pi pi-home" iconPos="top"
          :class="{ '!text-green-500': route.path === '/home', '!text-gray-800': route.path !== '/' }"
          @click="goTo('/home')" />

        <Button label="Transações" variant="text" rounded icon="pi pi-list" iconPos="top"
          :class="{ '!text-green-500': route.path === '/transactions', '!text-gray-800': route.path !== '/transactions' }"
          @click="goTo('/transactions')" />

        <Button label="Relatórios" variant="text" rounded icon="pi pi-chart-bar" iconPos="top"
          :class="{ '!text-green-500': route.path === '/reports', '!text-gray-800': route.path !== '/reports' }"
          @click="goTo('/reports')" />

        <Button label="Perfil" variant="text" rounded icon="pi pi-user" iconPos="top"
          :class="{ '!text-green-500': route.path === '/profile', '!text-gray-800': route.path !== '/profile' }"
          @click="goTo('/profile')" />

      </div>
    </IonToolbar>
  </IonFooter>
</template>