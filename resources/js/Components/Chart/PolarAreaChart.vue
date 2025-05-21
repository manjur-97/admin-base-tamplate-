<template>
  <div class="chart-container">
    <PolarArea :options="chartOptions" :data="chartData" />
  </div>
</template>

<script>
import {
  Chart as ChartJS,
  RadialLinearScale,
  ArcElement,
  Tooltip,
  Legend,
} from "chart.js";
import { PolarArea } from "vue-chartjs";

ChartJS.register(RadialLinearScale, ArcElement, Tooltip, Legend);

export default {
  name: "LoanPayChart",
  components: { PolarArea },
  data() {
    return {
    
      chartData: {
        labels: ["Remaining Loan", "Paid Amount", "Pending Amount"],
        datasets: [
          {
            label: "Loan Repayment Status",
            backgroundColor: [
              "#452B90", 
              "#F8B940",
              "#3A9B94", 
            ],
            data: [20000, 12000, 8000], 
          },
        ],
      },
      chartOptions: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            position: "top",
          },
          tooltip: {
            callbacks: {
              label: function (tooltipItem) {
                return tooltipItem.label + ": $" + tooltipItem.raw;
              },
            },
          },
        },
      },
    };
  },
};
</script>

<style scoped>
.chart-container {
  position: relative;
  width: 100%;
  height: 400px;
}
</style>
