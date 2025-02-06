<template></template>

<script setup>
import { usePage } from "@inertiajs/vue3";
import { useToast } from "vue-toast-notification";
import { watchEffect } from "vue";

const page = usePage();
const toast = useToast();

watchEffect(() => {
    const message = page.props.flash.success;

    if (message) {
        toast.open({
            message: message,
            type: "success",
            position: "top-right",
            duration: 3000,
            dismissible: true,
            queue: false,
        });
        page.props.flash.success = null;
    }
});
</script>
