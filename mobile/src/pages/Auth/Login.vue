<script setup>
import { ref } from 'vue';
import { IonPage, IonContent } from '@ionic/vue';
import LoginForm from '@/components/Auth/LoginForm.vue';
import { useAuthStore } from "@/stores/AuthStore";
import { useIonRouter } from '@ionic/vue';
import { Button } from 'primevue';

const { login } = useAuthStore();

const email = ref('');
const password = ref('');
const error = ref('');
const disable = ref(false);

const router = useIonRouter();

const submit = async () => {
  try {
    disable.value = true;

    await login({
      email: email.value,
      password: password.value
    });

    router.push('/');

  } catch (err) {
    error.value = err.message;
    disable.value = false;
  }
};
</script>

<template>
  <Ion-Page>
    <Ion-Content>
      <Button @click="router.push('/auth')" class="!ml-2 !mt-2" icon="pi pi-arrow-left" rounded
      aria-label="Voltar" />

      <div class="flex items-center justify-center mt-16 mb-12">
        <img src="/imgs/login_page.svg" alt="Ionic Vue logo" class="w-52" />
      </div>

      <div class="p-4">
        <h1 class="text-center text-2xl font-bold text-gray-800">
          Bem vindo de volta!
        </h1>
        <p class="text-center text-gray-700 text-sm mt-2">
          Faça login para continuar a utilizar seu aplicativo de finanças preferido.
        </p>

        <LoginForm @submit="submit" :error="error" :disable="disable" v-model:email="email"
          v-model:password="password" />
      </div>
    </Ion-Content>
  </Ion-Page>
</template>