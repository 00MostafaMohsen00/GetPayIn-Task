<template>
    <form @submit.prevent="submit">
        <fields :form="form" :categories="categories" />
    </form>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import Fields from "./Fields.vue";
const form = useForm({
    title: "",
    description: "",
    category_id: "",
    due_date: "",
});
defineProps({
    categories: Array,
});
const submit = () => {
    form.post(route("tasks.store"), form, {
        preserveScroll: true,
        preserveState: true,
    });
};
</script>
