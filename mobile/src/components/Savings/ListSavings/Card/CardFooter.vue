<script setup>
import { Button } from 'primevue';
import { useSavingStore } from '@/stores/SavingStore';

const props = defineProps(['saving']);

const useSaving = useSavingStore();

const deleteSaving = () => {
  useSaving.deleteSaving(props.saving.id);
}

const showModal = () => {
  useSaving.toggleModal();
  useSaving.setActualSaving(props.saving);
}
</script>
<template>
  <div class="flex gap-4 mt-1">
    <Button @click="showModal()" label="Reservar" severity="success" outlined class="w-[80%]" />

    <Button @click="deleteSaving()" :icon="'pi pi-trash'" severity="danger" outlined class="w-[30%]" />
  </div>
</template>