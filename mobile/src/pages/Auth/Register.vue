<script setup>
import { ref } from 'vue';
import { IonPage, IonContent } from '@ionic/vue';
import RegisterForm from '@/components/Auth/RegisterForm.vue';
import { useAuthStore } from "@/stores/AuthStore";
import { useRouter } from 'vue-router';
import { Button } from 'primevue';

const { register } = useAuthStore();

const name = ref('');
const password = ref('');
const email = ref('');
const error = ref('');
const disable = ref(false);

const router = useRouter();

const submit = async () => {
  try {
    disable.value = true;

    await register({ name: name.value, email: email.value, password: password.value });

    router.push('/home');

  } catch (err) {
    error.value = err.message;
    disable.value = false;
  }
};
</script>

<template>
  <Ion-Page>
    <Ion-Content>
      <Button @click="router.push('/auth')" class="!ml-2 !mt-2" icon="pi pi-arrow-left" rounded aria-label="Voltar" />

      <div class="flex items-center justify-center mt-16 mb-12">
        <img src="/imgs/register_page.svg" alt="Ionic Vue logo" class="w-52" />
      </div>

      <div class="p-4">
        <h1 class="text-center text-2xl font-bold text-gray-800">
          Crie sua conta e comece a economizar!
        </h1>
        <p class="text-center text-gray-700 text-sm mt-2">
          Com um bom planejamento financeiro, você pode conquistar seus objetivos.
        </p>

        <RegisterForm @submit="submit" :error="error" :disable="disable" v-model:name="name" v-model:email="email"
          v-model:password="password" />
      </div>
    </Ion-Content>
  </Ion-Page>
</template>