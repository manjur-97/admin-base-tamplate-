<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import BackendLayout from "@/Layouts/BackendLayout.vue";
import BarChart from "@/Components/Chart/BarChart.vue";
import PieChart from "@/Components/Chart/PieChart.vue";
import DoughnutChart from "@/Components/Chart/DoughnutChart.vue";
import LineChart from "@/Components/Chart/LineChart.vue";
import PolarAreaChart from "@/Components/Chart/PolarAreaChart.vue";
import RadarChart from "@/Components/Chart/RadarChart.vue";
import { displayResponse } from "@/responseMessage.js";
import { ref, onMounted } from "vue";

const props = defineProps(["dashboardData", "flash"]);

onMounted(() => {
  if (props.flash?.errorMessage) {
    displayResponse({
      props: { flash: { errorMessage: props.flash.errorMessage } },
    });
  }
});
const form = useForm({
  name: "",
  email: "",
  password: "",
  password_confirmation: "",
  terms: false,
});

const submit = () => {
  form.post(route("register"), {
    onFinish: () => form.reset("password", "password_confirmation"),
  });
};
</script>

<template>
  <BackendLayout>

  </BackendLayout>
</template>
<style scoped>

</style>
