<template>
    <form @submit.prevent="submit">
        <fields :form="form" :categories="categories" />
    </form>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import Fields from "./Fields.vue";
const props = defineProps({
    task: Object,
    categories: Array,
});

const form = useForm({
    title: props.task.title,
    description: props.task.description,
    category_id: props.task.category_id,
    due_date: props.task.due_date,
});

const submit = () => {
    form.put(route("tasks.update", props.task.id), form, {
        preserveScroll: true,
        preserveState: true,
    });
};
</script>
