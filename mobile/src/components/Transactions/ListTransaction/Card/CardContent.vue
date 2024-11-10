<script setup>
import { useUserStore } from '@/stores/UserStore';
import { computed } from 'vue';
import { useRouter } from 'vue-router';
defineProps(['transaction'])

const userStore = useUserStore();
const router = useRouter();

const showBalance = computed(() => userStore.showBalance);

const truncate = (text) => {
  if(!text) return '';
  const length = 50;
  if (text.length > length) {
    return text.substring(0, length) + '...';
  }

  return text;
};
</script>
<template>
  <div class="flex justify-between items-center" @click="router.push(`/transactions/edit/${transaction.id}`)">
    <div>
      <p class="text-lg">
        {{ transaction.name }}
      </p>
      <p class="text-sm">{{ transaction.created_at_human }}</p>
    </div>

    <div>
      <p class="text-lg" :class="transaction.type === 'income' ? 'text-green-500' : 'text-red-500'">
        R$ {{ showBalance ? transaction.amount : '---' }}
      </p>
      <p class="text-sm text-center font-semibold">{{ transaction.category?.name }}</p>
    </div>
  </div>

  <div class="mt-4">
    <p class="text-sm">{{ truncate(transaction.note) }}</p>
  </div>
</template>
