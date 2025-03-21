<template>
    <form @submit.prevent="submit">
        <fields :form="form" :platforms="platforms" />
    </form>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import Fields from "./Fields.vue";
defineProps({
    platforms: Array,
});
const form = useForm({
    title: "",
    content: "",
    status: "2",
    image: null,
    scheduled_time: "",
    platforms: [],
});

const submit = () => {
    form.post(route("posts.store"), form, {
        preserveScroll: true,
        preserveState: true,
    });
};
</script>
