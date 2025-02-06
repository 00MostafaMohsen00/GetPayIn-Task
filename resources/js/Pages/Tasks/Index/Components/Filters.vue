<template>
    <form @submit.prevent="">
        <div class="mb-4 mt-4 flex flex-wrap gap-4">
            <div class="flex flex-nowrap items-center gap-2">
                <input
                    v-model="filterForm.deleted"
                    type="checkbox"
                    id="deleted"
                    class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-400"
                />
                <label for="deleted">Deleted</label>
            </div>
            <div>
                <select
                    class="filter-input-l rtl:filter-input-r w-24"
                    v-model="filterForm.category_id"
                >
                    <option value="">All Categories</option>
                    <option
                        v-for="category in categories"
                        :key="category.id"
                        :value="category.id"
                    >
                        {{ category.name }}
                    </option>
                </select>
                <select
                    class="filter-input-r rtl:filter-input-l w-24"
                    v-model="filterForm.status"
                >
                    <option value="">All Status</option>
                    <option
                        v-for="(label, index) in statusLabels"
                        :key="index"
                        :value="index"
                    >
                        {{ label }}
                    </option>
                </select>
            </div>
            <div class="flex flex-nowrap items-center gap-2">
                <input
                    v-model="filterForm.due_date"
                    type="date"
                    id="due_date"
                    class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-400"
                />
                <label for="due_date">Due Date</label>
            </div>
            <div class="flex flex-nowrap items-center gap-2">
                <input
                    v-model="filterForm.search"
                    type="search"
                    id="search"
                    class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-400"
                />
                <label for="search">Search</label>
            </div>
            <div>
                <select
                    class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-400 w-24"
                    v-model="filterForm.sort"
                >
                    <option value="">Sort By</option>
                    <option
                        v-for="sort in sorts"
                        :key="sort.value"
                        :value="sort.value"
                    >
                        {{ sort.label }}
                    </option>
                </select>
            </div>
        </div>
    </form>
</template>

<script setup>
import { reactive, watch } from "vue";
import { router } from "@inertiajs/vue3";
import debounce from "lodash/debounce";

const props = defineProps({
    filters: Object,
    categories: Array,
    statusLabels: Array,
});

const sorts = [
    {
        label: "Newest",
        value: "desc",
    },
    {
        label: "Oldest",
        value: "asc",
    },
];

const filterForm = reactive({
    deleted: props.filters.deleted ?? false,
    category_id: props.category_id ?? "",
    status: props.status ?? "",
    page: props.filters.page ?? 1,
    due_date: props.filters.due_date ?? "",
    search: props.filters.search ?? "",
    sort: props.filters.sort ?? "",
});

watch(
    filterForm,
    debounce(() => {
        router.get(route("tasks.index"), filterForm, {
            replace: true,
            preserveState: true,
            preserveScroll: true,
        });
    }),
    1000
);
</script>
