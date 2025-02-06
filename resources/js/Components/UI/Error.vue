<template>
    <div class="error">{{ error }}</div>
</template>

<script setup>
defineProps({
    error: String,
});
</script>
