<template>
    <div class="flex gap-1">
        <Link
            v-for="(link, index) in links"
            :href="link.url"
            :key="index"
            v-html="link.label"
            class="by-2 px-4 rounded-md"
            :class="{
                'bg-indigo-500 dark:bg-indigo-800 text-gray-300': link.active,
            }"
        >
        </Link>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";
defineProps({
    links: Array,
});
</script>
