

<script setup>
defineProps({
    value: String,
    optional_data: String,
});
</script>


<template>

    <label class="d-block fw-bold fs-6 text-dark mb-1 text-muted custom-transition">
 
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>

        <span v-if="optional_data" v-html="optional_data"></span>
        <span v-else><slot /></span>

    </label>

</template>


<style scoped>

.custom-transition {
  transition: all 1s ease-in-out;
}

</style>