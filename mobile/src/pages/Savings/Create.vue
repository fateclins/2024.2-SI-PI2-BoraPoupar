<script setup>
import CreateSavingForm from '@/components/Savings/CreateSavingForm.vue';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { Button } from 'primevue';
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { useSavingStore } from '@/stores/SavingStore';

const router = useRouter();
const useSaving = useSavingStore();

const name = ref('');
const amount = ref();
const description = ref('');
const goal = ref();
const error = ref('');
const disable = ref(false);


const submit = async () => {
  disable.value = true;
  
  try {
    console.log({
      name: name.value,
      amount: amount.value,
      description: description.value,
      goal: goal.value,
    })
    await useSaving.createSaving({
      name: name.value,
      amount: amount.value,
      description: description.value,
      goal: goal.value,
    });

    router.push('/savings');

    resetForm();
  } catch (err) {
    error.value = err.message;
    disable.value = false;
  }
};

const resetForm = () => {
  name.value = '';
  amount.value = null;
  description.value = '';
  goal.value = null;
  error.value = '';
  disable.value = false;
};
</script>

<template>
  <AuthLayout>
    <Button @click="router.push('/savings')" class="!-ml-2 -!mt-2" icon="pi pi-arrow-left" rounded
      aria-label="Voltar" />

    <CreateSavingForm v-model:name="name" v-model:amount="amount" v-model:goal="goal" v-model:description="description"
      :disable="disable" :error="error" @submit="submit" />
  </AuthLayout>
</template>