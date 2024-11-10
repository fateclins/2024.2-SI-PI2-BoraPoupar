<script setup>
import { useUserStore } from '@/stores/UserStore';
import { computed } from 'vue';
const props = defineProps(['saving'])

const userStore = useUserStore();

const showBalance = computed(() => userStore.showBalance);

const truncate = (text) => {
  if (!text) return '';
  const length = 50;
  if (text.length > length) {
    return text.substring(0, length) + '...';
  }

  return text;
};
</script>
<template>
  <div class="flex justify-between items-center">
    <div>
      <p class="text-lg">
        {{ saving.name }}
      </p>
    </div>

    <div>
      <p class="text-lg text-green-500">
        R$ {{ showBalance ? saving.amount : '---' }}
      </p>
    </div>
  </div>

  <div class="mt-4">
    <p class="text-sm">{{ truncate(saving.description) }}</p>
  </div>
</template>
