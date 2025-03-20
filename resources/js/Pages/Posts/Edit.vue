<template>
    <form @submit.prevent="submit">
        <fields :form="form" />
    </form>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import Fields from "./Fields.vue";
const props = defineProps({
    post: Object,
});

const form = useForm({
    title: props.post.title,
    content: props.post.content,
    image: "",
    image_url: props.post.image,
    scheduled_time: props.post.scheduled_time,
    id: props.post.id,
    status: props.post.status,
});

const submit = () => {
    form.status = "2";
    form.post(route("posts.update", props.post.id), form, {
        preserveScroll: true,
        preserveState: true,
    });
};
</script>
