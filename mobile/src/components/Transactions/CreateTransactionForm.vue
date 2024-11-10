<script setup>
import { Button, InputText, InputNumber, IftaLabel, Textarea, Select } from 'primevue';
import InputGroup from 'primevue/inputgroup';
import InputGroupAddon from 'primevue/inputgroupaddon';

const props = defineProps(['error', 'disable', 'categories', 'categoriesSelectDisabled']);

const emit = defineEmits(['submit']);

const amount = defineModel('amount');
const note = defineModel('note');
const name = defineModel('name');
const type = defineModel('type');
const category = defineModel('category');

const types = [
  { name: 'Receita', value: 'income' },
  { name: 'Despesa', value: 'expense' },
];

const submit = () => {
  emit('submit');
};
</script>

<template>
  <div class="mt-12">
    <InputGroup>
      <InputGroupAddon>
        <i class="pi pi-hashtag"></i>
      </InputGroupAddon>
      <InputText :required="true" v-model="name" placeholder="Nome da transação" :disabled="disable" />
    </InputGroup>

    <InputGroup class="mt-4">
      <InputGroupAddon>
        <span>R$</span>
      </InputGroupAddon>
      <InputNumber :required="true" placeholder="Valor" inputId="amount" v-model="amount" :disabled="disable" locale="pt-BR"
        :minFractionDigits="0" :maxFractionDigits="2" />
    </InputGroup>

    <InputGroup class="mt-4">
      <InputGroupAddon>
        <i class="pi pi-tag"></i>
      </InputGroupAddon>
      <Select v-model="type" :required="true" :options="types" optionLabel="name" placeholder="Selecione o tipo"
        class="w-full md:w-56" />
    </InputGroup>

    <InputGroup class="mt-4">
      <InputGroupAddon>
        <i class="pi pi-bookmark"></i>
      </InputGroupAddon>
      <Select :disabled="categories.length === 0 || categoriesSelectDisabled"
      v-model="category" :options="categories" optionLabel="name"
        placeholder="Selecione uma categoria" class="w-full md:w-56" />
    </InputGroup>


    <div class="mt-4">
      <IftaLabel>
        <Textarea id="note_textarea" class="w-full" v-model="note" rows="5" style="resize: none" />
        <label for="note_textarea" class="!bg-transparent">
          <i class="pi pi-pencil mr-2"></i>
          <span>Nota</span>
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