<template>
    <h1 class="text-3xl mb-4">Your Tasks</h1>
    <section>
        <filters
            :filters="filters"
            :categories="categories"
            :statusLabels="statusLabels"
        />
    </section>
    <section
        v-if="tasks.data.length"
        class="grid grid-cols-1 lg:grid-cols-2 gap-2"
    >
        <Box
            v-for="task in tasks.data"
            :key="task.id"
            :class="{ 'border-dashed': task.deleted_at }"
        >
            <div
                class="flex flex-col md:flex-row gap-2 md:items-center justify-between"
                :class="{ 'opacity-50': task.deleted_at }"
            >
                <div
                    v-if="task.status == '1'"
                    class="text-xs font-bold uppercase border border-dashed p-1 border-green-300 text-green-500 dark:border-green-600 dark:text-green-600 inline-block rounded-md mb-2"
                >
                    Done
                </div>
                <div class="grid grid-cols-2 gap-5">
                    <div>{{ task.title }}</div>
                    <div class="text-gray-500">Due: {{ task.due_date }}</div>
                    <div class="text-gray-500">{{ task.description }}</div>
                    <div class="text-gray-500">
                        Category : {{ task.category.name }}
                    </div>
                </div>
            </div>
            <div
                class="flex items-center gap-1 text-gray-600 dark:text-gray-300 my-2 w-full"
                v-if="!task.deleted_at"
            >
                <Link
                    class="btn-outline w-full text-center"
                    :href="route('tasks.edit', task.id)"
                >
                    <i class="fas fa-edit icon"></i>
                </Link>
                <Link
                    class="btn-outline w-full text-center"
                    method="delete"
                    as="button"
                    :href="route('tasks.destroy', task.id)"
                >
                    <i class="fas fa-trash icon"></i>
                </Link>

                <Link
                    class="btn-outline w-full text-center"
                    :href="route('task.done', task.id)"
                    v-if="task.status == '0'"
                >
                    <i class="fas fa-check icon"></i>
                </Link>
            </div>
            <div
                class="flex items-center gap-1 text-gray-600 dark:text-gray-300 my-8"
                v-if="task.deleted_at"
            >
                <Link
                    class="btn-outline w-full text-center"
                    :href="route('task.restore', task.id)"
                >
                    <i class="fas fa-trash-restore icon"></i>
                </Link>
                <delete-button :url="route('task.forceDelete', task.id)" />
            </div>
        </Box>
    </section>

    <empty v-else>No Tasks</empty>
    <section v-if="tasks.data.length">
        <div class="w-full flex justify-center mt-4 mb-4">
            <pagination :links="tasks.links" />
        </div>
    </section>
</template>
<script setup>
import Box from "@/Components/UI/Box.vue";
import Filters from "@/Pages/Tasks/Index/Components/Filters.vue";
import Pagination from "@/Components/UI/Pagination.vue";
import Empty from "@/Components/UI/Empty.vue";
import DeleteButton from "@/Components/UI/DeleteButton.vue";
import { Link } from "@inertiajs/vue3";
defineProps({
    tasks: Array,
    filters: Object,
    categories: Array,
    statusLabels: Array,
});
</script>
