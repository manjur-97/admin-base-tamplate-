<template>
    <div class="chart-container">
      <Line id="my-chart-id" :options="chartOptions" :data="chartData" />
    </div>
  </template>

<script>
import {
  Chart as ChartJS,
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  Title,
  Tooltip,
  Legend,
} from "chart.js";
import { Line } from "vue-chartjs";

ChartJS.register(
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  Title,
  Tooltip,
  Legend
);

export default {
  name: "LineChart",
  components: { Line },
  props: {
    // Define the prop to accept 'countLoanAmountByMonth'
    countLoanCollectionAmountByMonth: {
      type: Object,
      required: true,
    },
  },

  data() {
    return {
      chartData: {
        labels: [
          "January",
          "February",
          "March",
          "April",
          "May",
          "June",
          "July",
          "August",
          "September",
          "October",
          "November",
          "December",
        ],
        datasets: [
          {
            label: "Loan Collection Record",
            backgroundColor: "#452B90",
            borderColor: "#452B90",
            data: Object.values(this.countLoanCollectionAmountByMonth),
           
          },
        ],
      },
      chartOptions: {
        responsive: true,
        plugins: {
         
          tooltip: {
            mode: "index",
            intersect: false,
          },
        },
        scales: {
          x: {
            title: {
              display: true,
              text: "Months",
            },
          },
          y: {
            title: {
              display: true,
              text: "Amount (TK)",
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
  height: 100%; /* Makes the chart take up the full height of its container */
  width: 100%;  /* Ensures the chart takes up the full width */
}
</style>
