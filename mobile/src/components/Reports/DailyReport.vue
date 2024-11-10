<script setup>
import { ref, onMounted } from 'vue';
import { Chart, registerables } from 'chart.js';

Chart.register(...registerables);

const props = defineProps(['transactions']);

const dailyReport = ref(null);

onMounted(() => {
  const ctx = dailyReport.value.getContext('2d');

  const today = new Date().toLocaleDateString();

  const incomes = props.transactions.filter(transaction => {
    const transactionDate = new Date(transaction.created_at).toLocaleDateString();
    return transaction.type === 'income' && transactionDate === today;
  });

  const expenses = props.transactions.filter(transaction => {
    const transactionDate = new Date(transaction.created_at).toLocaleDateString();
    return transaction.type === 'expense' && transactionDate === today;
  });

  const dailyIncomes = incomes.reduce((acc, transaction) => {
    const date = new Date(transaction.created_at).toLocaleDateString();
    acc[date] = acc[date] || 0;
    acc[date] += transaction.amount;
    return acc;
  }, {});

  const dailyExpenses = expenses.reduce((acc, transaction) => {
    const date = new Date(transaction.created_at).toLocaleDateString();
    acc[date] = acc[date] || 0;
    acc[date] += transaction.amount;
    return acc;
  }, {});

  const totalIncome = Object.values(dailyIncomes).reduce((sum, value) => sum + value, 0);
  const totalExpense = Object.values(dailyExpenses).reduce((sum, value) => sum + value, 0);

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Receitas', 'Despesas'],
      datasets: [
        {
          label: 'Resumo Diário',
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
    <canvas ref="dailyReport"></canvas>
  </div>
</template>