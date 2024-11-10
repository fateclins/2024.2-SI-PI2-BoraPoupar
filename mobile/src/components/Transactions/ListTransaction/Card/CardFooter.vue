<script setup lang="ts">
import { Button } from 'primevue';
import { useTransactionStore } from '@/stores/TransactionStore';

const props = defineProps(['transaction'])

const useTransaction = useTransactionStore();

const deleteTransaction = () => {
  useTransaction.deleteTransaction(props.transaction.id);
}
</script>
<template>
  <div class="flex gap-4 mt-1">
    <Button @click="deleteTransaction()"
    label="Excluir" severity="danger" outlined class="w-full" />
  </div>
</template>