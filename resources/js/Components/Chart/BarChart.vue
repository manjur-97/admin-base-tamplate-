<template>
  <div>
    <Bar id="my-chart-id" :options="chartOptions" :data="chartData" />
  </div>
</template>

<script>
import { Bar } from "vue-chartjs";
import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  BarElement,
  CategoryScale,
  LinearScale,
} from "chart.js";

ChartJS.register(
  Title,
  Tooltip,
  Legend,
  BarElement,
  CategoryScale,
  LinearScale
);

export default {
  name: "BarChart",
  components: { Bar },

  props: {
    // Define the prop to accept 'countLoanAmountByMonth'
    countLoanAmountByMonth: {
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
            label: "Total Approved Loan",
            backgroundColor: ["#3A9B94", "#F8B940", "#452B90", "#58bad7"],
            data: Object.values(this.countLoanAmountByMonth),
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
