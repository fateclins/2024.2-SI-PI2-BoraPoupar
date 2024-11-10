<script setup>
import { Button, InputText, InputNumber, IftaLabel, Textarea } from 'primevue';
import InputGroup from 'primevue/inputgroup';
import InputGroupAddon from 'primevue/inputgroupaddon';

const props = defineProps(['error', 'disable']);

const emit = defineEmits(['submit']);

const amount = defineModel('amount');
const description = defineModel('description');
const name = defineModel('name');
const goal = defineModel('goal');

const submit = () => {
  emit('submit');
};
</script>

<template>
  <div class="mt-12">
    <InputGroup>
      <InputGroupAddon>
        <i class="pi pi-tag"></i>
      </InputGroupAddon>
      <InputText :required="true" v-model="name" placeholder="Nome da Caixinha" :disabled="disable" />
    </InputGroup>

    <InputGroup class="mt-4">
      <InputGroupAddon>
        <span>R$</span>
      </InputGroupAddon>
      <InputNumber :required="true" placeholder="Valor já reservado" inputId="amount" v-model="amount"
        :disabled="disable" locale="pt-BR" :minFractionDigits="0" :maxFractionDigits="2" />
    </InputGroup>

    <div class="mt-4">
      <InputGroup class="">
        <InputGroupAddon>
          <span>R$</span>
        </InputGroupAddon>
        <InputNumber :required="true" placeholder="Meta de Reserva" inputId="goal" v-model="goal" :disabled="disable"
          locale="pt-BR" :minFractionDigits="0" :maxFractionDigits="2" />
      </InputGroup>
    </div>

    <div class="mt-4">
      <IftaLabel>
        <Textarea id="description_textarea" class="w-full" v-model="description" rows="5" style="resize: none" />
        <label for="description_textarea" class="!bg-transparent">
          <i class="pi pi-pencil mr-2"></i>
          <span>
            Descrição
          </span>
        </label>
      </IftaLabel>
    </div>

    <div class="mt-4" v-if="error">
      <p class="text-red-500 text-sm">{{ error }}</p>
    </div>

    <Button @click="submit" icon="pi pi-plus" iconPos="right" :loading="disable" :disabled="disable" label="Criar"
      class="w-full mt-4" />
  </div>
</template>