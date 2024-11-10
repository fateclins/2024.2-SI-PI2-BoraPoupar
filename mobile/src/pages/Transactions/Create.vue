<script setup>
import CreateTransactionForm from '@/components/Transactions/CreateTransactionForm.vue';
import AuthLayout from '@/layouts/AuthLayout.vue';
import { Button } from 'primevue';
import { computed, onMounted, ref, watch } from 'vue';
import { useRouter } from 'vue-router';
import { useTransactionStore } from '@/stores/TransactionStore';

const router = useRouter();
const useTransaction = useTransactionStore();

const categories = ref([]);
const categoriesSelectDisabled = ref(false);

const name = ref('');
const amount = ref(null);
const type = ref('');
const note = ref('');
const category = ref('');
const error = ref('');
const disable = ref(false);

watch(type, async (newValue) => {
  categoriesSelectDisabled.value = true;
  if (newValue.value === 'income') {
    categories.value = await useTransaction.getCategories('income');
  } else {
    categories.value = await useTransaction.getCategories('expense');
  }
  categoriesSelectDisabled.value = false;
});

const submit = async () => {
  disable.value = true;
  
  try {
    await useTransaction.createTransaction({
      name: name.value,
      amount: amount.value,
      type: type.value.value,
      note: note.value,
      category_id: category.value.id,
    });

    router.push('/transactions');

    resetForm();
  } catch (err) {
    error.value = err.message;
    disable.value = false;
  }
};

const resetForm = () => {
  name.value = '';
  amount.value = 0;
  type.value = '';
  note.value = '';
  category.value = '';
  error.value = '';
  disable.value = false;
};
</script>

<template>
  <AuthLayout>
    <Button @click="router.push('/transactions')" class="!-ml-2 -!mt-2" icon="pi pi-arrow-left" rounded
      aria-label="Nova transaction" />

    <CreateTransactionForm :categories v-model:name="name" v-model:amount="amount" v-model:type="type" :error="error"
      v-model:note="note" v-model:category="category" :categoriesSelectDisabled @submit="submit" />
  </AuthLayout>
</template>