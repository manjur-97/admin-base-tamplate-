<template>
  <div class="chart-container">
    <Line :options="chartOptions" :data="chartData" />
  </div>
</template>

<script>
import { Line } from "vue-chartjs";
import {
  Chart as ChartJS,
  CategoryScale,
  LinearScale,
  LineElement,
  Title,
  Tooltip,
  Legend,
} from "chart.js";

ChartJS.register(
  CategoryScale,
  LinearScale,
  LineElement,
  Title,
  Tooltip,
  Legend
);

export default {
  name: "AttendanceLineChart",
  components: { Line },
  data() {
    return {
      chartData: {
        labels: [
          "1",
          "2",
          "3",
          "4",
          "5",
          "6",
          "7",
          "8",
          "9",
          "10",
          "11",
          "12",
          "13",
          "14",
          "15",
          "16",
          "17",
          "18",
          "19",
          "20",
          "21",
          "22",
          "23",
          "24",
          "25",
          "26",
          "27",
          "28",
          "29",
          "30",
          "31",
        ],
        datasets: [
          {
            label: "In Time",
            data: [
              2, 3, 4, 5, 6, 7, 3, 2, 5, 6, 8, 7, 6, 4, 5, 7, 8, 4, 6, 5, 7, 8,
              6, 4, 5, 7, 8, 6, 4, 7, 5,
            ], // In Time data (mapped to time range: 7:00 AM to 10:00 PM)
            borderColor: "#452B90",
            fill: false,
            tension: 0.1,
          },
          {
            label: "Out Time",
            data: [
              5, 6, 7, 8, 9, 10, 7, 8, 9, 10, 7, 8, 9, 6, 7, 8, 9, 6, 7, 8, 9,
              10, 8, 7, 9, 10, 8, 7, 6, 9, 10,
            ], // Out Time data (mapped to time range: 7:00 AM to 10:00 PM)
            borderColor: "#F8B940",
            fill: false,
            tension: 0.1,
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
                return (
                  tooltipItem.dataset.label + ": " + tooltipItem.raw + " day(s)"
                );
              },
            },
          },
        },
        scales: {
          x: {
            title: {
              display: true,
              text: "Days of the Month",
            },
          },
          y: {
            title: {
              display: true,
              text: "Time",
            },
            beginAtZero: true,
            ticks: {
              // Use the following format for time
              callback: function (value, index, values) {
                const times = [
                  "7:00 AM",
                  "8:00 AM",
                  "9:00 AM",
                  "10:00 AM",
                  "11:00 AM",
                  "12:00 PM",
                  "1:00 PM",
                  "2:00 PM",
                  "3:00 PM",
                  "4:00 PM",
                  "5:00 PM",
                  "6:00 PM",
                  "7:00 PM",
                  "8:00 PM",
                  "9:00 PM",
                  "10:00 PM",
                ];
                return times[value]; // Adjust based on the value from your data
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
