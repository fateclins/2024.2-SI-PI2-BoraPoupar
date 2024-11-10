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
const amount = ref(0);
const type = ref('');
const note = ref('');
const category = ref('');

watch(type, async (newValue) => {
  categoriesSelectDisabled.value = true;
  if (newValue.value === 'income') {
    categories.value = await useTransaction.getCategories('income');
  } else {
    categories.value = await useTransaction.getCategories('expense');
  }
  categoriesSelectDisabled.value = false;
});
</script>

<template>
  <AuthLayout>
    <Button @click="router.push('/transactions')" class="!-ml-2 -!mt-2" icon="pi pi-arrow-left" rounded
      aria-label="Nova transaction" />

    <CreateTransactionForm :categories v-model:name="name" v-model:amount="amount" v-model:type="type"
      v-model:note="note" v-model:category="category" :categoriesSelectDisabled @submit="" />
  </AuthLayout>
</template>