<template>
    <h1 class="text-3xl mb-4">Your Posts</h1>
    <section>
        <filters :filters="filters" :statusLabels="statusLabels" />
    </section>
    <section
        v-if="posts.data.length"
        class="grid grid-cols-1 lg:grid-cols-2 gap-2"
    >
        <Box v-for="post in posts.data" :key="post.id">
            <div class="flex flex-row gap-2 flex-wrap">
                <div class="grid grid-cols-3 gap-5">
                    <div>{{ post.title }}</div>
                    <div class="text-gray-500">
                        <i class="fas fa-clock"></i> {{ post.scheduled_time }}
                    </div>
                    <div
                        class="text-xs text-center font-bold uppercase border border-dashed inline-block rounded-md"
                        :class="{
                            'bg-green-100 text-green-800': post.status == '1',
                            'bg-yellow-100 text-yellow-800': post.status == '0',
                            'bg-blue-100 text-blue-800': post.status == '2',
                        }"
                    >
                        {{ post.status_text }}
                    </div>
                </div>
            </div>
            <div class="text-gray-500">{{ post.content }}</div>

            <div class="flex items-center gap-2" v-if="post.image">
                <img :src="post.image" alt="Image" class="w-full h-auto" />
            </div>
            <platforms :platforms="post.platforms" />
            <div
                class="flex items-center gap-1 text-gray-600 dark:text-gray-300 my-2 w-full"
            >
                <Link
                    class="btn-outline w-full text-center"
                    v-if="post.status != '1'"
                    :href="route('posts.edit', post.id)"
                >
                    <i class="fas fa-edit icon"></i>
                </Link>
                <Link
                    class="btn-outline w-full text-center"
                    method="delete"
                    as="button"
                    :href="route('posts.destroy', post.id)"
                >
                    <i class="fas fa-trash icon"></i>
                </Link>
            </div>
        </Box>
    </section>

    <empty v-else>No Posts</empty>
    <section v-if="posts.data.length">
        <div class="w-full flex justify-center mt-4 mb-4">
            <pagination :links="posts.links" />
        </div>
    </section>
</template>
<script setup>
import Box from "@/Components/UI/Box.vue";
import Filters from "@/Pages/Posts/Index/Components/Filters.vue";
import Pagination from "@/Components/UI/Pagination.vue";
import Empty from "@/Components/UI/Empty.vue";
import Platforms from "@/Pages/Posts/Index/Components/Platforms.vue";
import { Link } from "@inertiajs/vue3";
defineProps({
    posts: Array,
    filters: Object,
    statusLabels: Array,
});
</script>
