<script setup>
import EditTransactionForm from '@/components/Transactions/EditTransactionForm.vue';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { Button, Toast } from 'primevue';
import { onMounted, ref } from 'vue';
import { useRouter } from 'vue-router';
import { useRoute } from 'vue-router';
import { useTransactionStore } from '@/stores/TransactionStore';
import LoadingState from '@/components/Transactions/ListTransaction/LoadingState.vue';
import { useToast } from 'primevue/usetoast';

const toast = useToast();
const router = useRouter();
const route = useRoute();
const useTransaction = useTransactionStore();

const name = ref('');
const amount = ref(0);
const note = ref('');
const error = ref('');
const disable = ref(false);
const loading = ref(false);

const submit = async () => {
  disable.value = true;

  try {
    await useTransaction.updateTransaction({
      name: name.value,
      amount: amount.value,
      note: note.value,
      id: route.params.id,
    });

    toast.add({ severity: 'success', summary: 'Sucesso', detail: 'Transação atualizada com sucesso' });
  } catch (err) {
    error.value = err.message;
    toast.add({ severity: 'error', summary: 'Erro', detail: 'Erro ao atualizar transação' });
    disable.value = false;
  }
};

onMounted(async () => {
  loading.value = true;
  if (route.params.id) {
    const transaction = await useTransaction.getTransaction(route.params.id);
    name.value = transaction.name;
    amount.value = transaction.amount;
    note.value = transaction.note;
  }
  loading.value = false;
});
</script>

<template>
  <AuthLayout>
    <Button @click="router.push('/transactions')" class="!-ml-2 -!mt-2" icon="pi pi-arrow-left" rounded
      aria-label="Nova transaction" />

    <template v-if="loading">
      <LoadingState />
    </template>

    <template v-else>
      <div class="px-4">
        <Toast position="bottom-center" />
      </div>

      <EditTransactionForm v-model:name="name" v-model:amount="amount"
        :error="error" v-model:note="note"
        @submit="submit" />
    </template>
  </AuthLayout>
</template>