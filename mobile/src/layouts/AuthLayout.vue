<script setup>
import {
  IonContent,
  IonPage,
} from '@ionic/vue';
import AppFooter from '@/components/App/AppFooter.vue';

</script>

<template>
  <IonPage>
    <IonContent class="ion-padding" fullscreen>
      <div class="px-6 pt-4">
        <slot name="header"/>

        <slot />

      </div>
    </IonContent>

    <AppFooter />
  </IonPage>
</template>

<style scoped>
.ion-page {
  display: flex;
  flex-direction: column;
  height: 100vh;
}

.ion-content {
  flex: 1;
}
</style>