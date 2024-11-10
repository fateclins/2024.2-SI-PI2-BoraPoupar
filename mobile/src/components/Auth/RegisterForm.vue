<script setup>
import { Button, InputText, Password } from 'primevue';
import InputGroup from 'primevue/inputgroup';
import InputGroupAddon from 'primevue/inputgroupaddon';

defineProps(['error', 'disable']);

const emit = defineEmits(['submit']);

const name = defineModel('name');
const email = defineModel('email');
const password = defineModel('password');

const submit = () => {
  emit('submit');
};
</script>

<template>
  <div class="mt-12">
    <InputGroup>
      <InputGroupAddon>
        <i class="pi pi-user"></i>
      </InputGroupAddon>
      <InputText v-model="name" placeholder="Nome" :disabled="disable" />
    </InputGroup>

    <InputGroup class="mt-4">
      <InputGroupAddon>
        <i class="pi pi-envelope"></i>
      </InputGroupAddon>
      <InputText placeholder="E-mail" v-model="email" :disabled="disable" />
    </InputGroup>

    <InputGroup class="mt-4">
      <InputGroupAddon>
        <i class="pi pi-lock"></i>
      </InputGroupAddon>
      <Password placeholder="Senha" v-model="password" toggleMask :feedback="false" :disabled="disable" />
    </InputGroup>

    <div class="mt-4" v-if="error">
        <p class="text-red-500 text-sm">{{ error }}</p>
    </div>

    <Button @click="submit" icon="pi pi-sign-in" iconPos="right"
    :loading="disable" :disabled="disable"
    label="Cadastrar" class="w-full mt-4" />
  </div>
</template>