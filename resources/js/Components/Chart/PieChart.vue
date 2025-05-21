<template>
  <Pie id="my-chart-id" :options="chartOptions" :data="chartData" />
</template>

<script>
import { Chart as ChartJS, ArcElement, Tooltip, Legend } from 'chart.js';
import { Pie } from 'vue-chartjs';

ChartJS.register(ArcElement, Tooltip, Legend);

export default {
  name: 'PieChart',
  components: { Pie },
  props: {
    sectionCounts: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      chartData: {
        labels: [],
        datasets: [
          {
            backgroundColor: ['#3A9B94', '#F8B940', '#452B90', '#58bad7', '#FF6384'],
            data: [],
          },
        ],
      },
      chartOptions: {
        responsive: true,
        maintainAspectRatio: false,
      },
    };
  },
  mounted() {
    this.updateChartData();
  },
  watch: {
    sectionCounts: {
      handler: 'updateChartData',
      deep: true,
    },
  },
  methods: {
    updateChartData() {
      if (this.sectionCounts) {
        console.log(this.sectionCounts); 
        this.chartData = {
          labels: this.sectionCounts.labels || [],
          datasets: [
            {
              backgroundColor: ['#3A9B94', '#F8B940', '#452B90', '#58bad7', '#FF6384'],
              data: this.sectionCounts.data || [],
            },
          ],
        };

      
        this.$nextTick(() => {
          this.$forceUpdate();
        });
      }
    },
  },
};
</script>
