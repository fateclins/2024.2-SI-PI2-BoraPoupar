<script setup>
import { IonPage, IonContent} from '@ionic/vue';
import { Button } from 'primevue';
</script>

<template>
  <Ion-Page>
    <Ion-Content>

      <div class="flex items-center justify-center mt-16 mb-12">
        <img src="/imgs/auth_page.svg" alt="Ionic Vue logo" class="w-52" />
      </div>

      <div class="p-4">
        <h1 class="text-center text-2xl font-bold text-gray-800">
          Bem-vindo ao Bora Poupar!
        </h1>
        <p class="text-center text-gray-700 text-sm mt-2">
          Acompanhe suas finanças de forma simples e eficiente.
        </p>

        <div class="mt-12">
          <Button @click="() => $router.push('/auth/register')"
          label="Começar a economizar" class="w-full !text-gray-8100 font-bold" />

          <Button @click="() => $router.push('/auth/login')"
          label="Já tenho uma conta" class="w-full mt-4 !bg-blue-400 !border-none" />
        </div>
      </div>


    </Ion-Content>
  </Ion-Page>
</template>

<style scoped></style>