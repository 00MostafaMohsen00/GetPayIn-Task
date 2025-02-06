<template>
    <Header />
    <main class="container mx-auto p-4 w-full min-h-screen">
        <Message />
        <slot></slot>
    </main>
    <Footer />
    <!-- Print the success message -->
</template>

<script setup>
import Header from "@/Components/UI/Header.vue";
import Message from "@/Components/UI/Message.vue";
import Footer from "@/Components/UI/Footer.vue";
</script>
