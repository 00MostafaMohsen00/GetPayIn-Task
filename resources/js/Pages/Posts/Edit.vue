<template>
    <form @submit.prevent="submit">
        <fields :form="form" :platforms="platforms" />
    </form>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import Fields from "./Fields.vue";
const props = defineProps({
    post: Object,
    platforms: Array,
});

const form = useForm({
    title: props.post.title,
    content: props.post.content,
    image: "",
    image_url: props.post.image,
    scheduled_time: props.post.scheduled_time,
    id: props.post.id,
    status: props.post.status,
    platforms: props.post.platforms.map((platform) => ({
        id: platform.id,
        name: platform.name,
    })),
});

const submit = () => {
    form.status = "2";
    form.platforms = form.platforms.map((platform) =>
        typeof platform === "object" && platform.id ? platform.id : platform
    );
    form.post(route("posts.update", props.post.id), form, {
        preserveScroll: true,
        preserveState: true,
    });
};
</script>
