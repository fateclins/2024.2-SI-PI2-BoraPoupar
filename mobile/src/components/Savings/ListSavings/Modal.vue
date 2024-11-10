<script setup>
import { computed, ref, watch } from 'vue';
import { Button, Dialog, InputNumber, InputGroup, InputGroupAddon } from 'primevue';
import { useSavingStore } from '@/stores/SavingStore';

const useSaving = useSavingStore();
const visible = computed(() => useSaving.showSavingModal);
const amount = ref();

watch(visible, (value) => {
  if (value) {
    amount.value = useSaving.actualSaving.amount;
  }
});

const save = () => {
  useSaving.saveAmount(amount.value);
  useSaving.toggleModal();
}
</script>

<template>
  <Dialog v-model:visible="visible" header="Poupe!" modal :style="{ width: '25rem' }">

    <InputGroup class="mt-4 mb-4">
      <InputGroupAddon>
        <span>R$</span>
      </InputGroupAddon>
      <InputNumber :required="true" placeholder="Valor já reservado" inputId="amount" v-model="amount" locale="pt-BR"
        :minFractionDigits="0" :maxFractionDigits="2" />
    </InputGroup>

    <div class="flex justify-end gap-2">
      <Button type="button" label="Cancelar" severity="secondary" @click="useSaving.toggleModal()"></Button>
      <Button type="button" label="Salvar" @click="save()"></Button>
    </div>

  </Dialog>
</template>
<style scoped></style>