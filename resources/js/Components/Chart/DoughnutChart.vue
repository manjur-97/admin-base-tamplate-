<template>
    <Doughnut id="my-chart-id" :options="chartOptions" :data="chartData" />
</template>

<script>
import { Chart as ChartJS, ArcElement, Tooltip, Legend } from 'chart.js'
import { Doughnut } from 'vue-chartjs'

ChartJS.register(ArcElement, Tooltip, Legend)

export default {
    name: 'DoughnutChart',
    components: { Doughnut },
    data() {
        return {
            chartData: {
                labels: ['Department A', 'Department B', 'Department C', 'Department D'],
                datasets: [
                    {
                        backgroundColor: ['#3A9B94', '#F8B940', '#452B90', '#58bad7'],
                        data: [25, 35, 20, 20]
                    }]
            },
            chartOptions: {
                responsive: true,
                maintainAspectRatio: false
            }
        }
    }
}
</script>
