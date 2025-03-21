<template>
    <div class="flex flex-wrap gap-2 m-2">
        <label
            v-for="platform in platforms"
            :key="platform.id"
            class="label border border-dashed border-gray-500 inline-block rounded-md text-center p-2"
            >{{ platform.name }}</label
        >
    </div>
</template>

<script setup>
defineProps({
    platforms: Array,
});
</script>
