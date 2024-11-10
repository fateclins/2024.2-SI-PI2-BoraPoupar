<script setup>
import { ref, onMounted } from 'vue';
import { Chart, registerables } from 'chart.js';

Chart.register(...registerables);

const props = defineProps(['transactions']);

const monthlyReport = ref(null);

onMounted(() => {
  const ctx = monthlyReport.value.getContext('2d');

  const currentMonth = new Date().getMonth();
  const currentYear = new Date().getFullYear();

  const incomes = props.transactions.filter(transaction => {
    const transactionDate = new Date(transaction.created_at);
    return transaction.type === 'income' && transactionDate.getMonth() === currentMonth && transactionDate.getFullYear() === currentYear;
  });

  const expenses = props.transactions.filter(transaction => {
    const transactionDate = new Date(transaction.created_at);
    return transaction.type === 'expense' && transactionDate.getMonth() === currentMonth && transactionDate.getFullYear() === currentYear;
  });

  const totalIncome = incomes.reduce((sum, transaction) => sum + transaction.amount, 0);
  const totalExpense = expenses.reduce((sum, transaction) => sum + transaction.amount, 0);

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Receitas', 'Despesas'],
      datasets: [
        {
          label: 'Resumo Mensal',
          data: [totalIncome, totalExpense],
          backgroundColor: [
            'rgba(75, 192, 192, 0.2)',
            'rgba(255, 99, 132, 0.2)'
          ],
          borderColor: [
            'rgba(75, 192, 192, 1)',
            'rgba(255, 99, 132, 1)'
          ],
          borderWidth: 1
        }
      ]
    },
    options: {
      plugins: {
        legend: {
          display: false
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            callback: function(value) {
              return 'R$ ' + value;
            }
          }
        }
      }
    }
  });
});
</script>

<template>
  <div>
    <canvas ref="monthlyReport"></canvas>
  </div>
</template>