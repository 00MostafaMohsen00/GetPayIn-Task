<template>
    <form @submit.prevent="submit">
        <fields :form="form" />
    </form>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import Fields from "./Fields.vue";
const form = useForm({
    title: "",
    content: "",
    status: "2",
    image: null,
    scheduled_time: "",
});

const submit = () => {
    form.post(route("posts.store"), form, {
        preserveScroll: true,
        preserveState: true,
    });
};
</script>
