<script setup>
defineProps({
    message: String,
});
</script>

<template>
    <div v-show="message">
        <p class="fs-6 text-danger">
            {{ message }}
        </p>
    </div>
</template>
