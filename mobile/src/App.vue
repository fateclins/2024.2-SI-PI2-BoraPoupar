<template>
  <ion-app>
    <ion-router-outlet :key="$route.fullPath" />
  </ion-app>
</template>

<script setup lang="ts">
import { IonApp, IonRouterOutlet } from '@ionic/vue';

localStorage.theme = 'light';
</script>
