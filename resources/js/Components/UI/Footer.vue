<template>
    <footer class="w-full">
        <Box
            class="flex justify-center align-center my-5 mx-2 dark:bg-gray-800"
        >
            <span class="font-bold text-indigo-500">{{ app_name }} </span>
        </Box>
    </footer>
</template>

<script setup>
import Box from "@/Components/UI/Box.vue";
import { ref } from "vue";
const app_name = ref(import.meta.env.VITE_APP_NAME);
</script>
