<template>
    <form @submit.prevent="">
        <div class="mb-4 mt-4 flex flex-wrap gap-4">
            <div>
                <select
                    class="filter-input-l rtl:filter-input-r w-24"
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
            <div
                class="flex flex-nowrap items-center gap-2 ilter-input-r rtl:filter-input-l"
            >
                <input
                    v-model="filterForm.date"
                    type="date"
                    id="due_date"
                    class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-400"
                />
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
    statusLabels: Array,
});

const filterForm = reactive({
    status: props.status ?? "",
    page: props.filters.page ?? 1,
    date: props.filters.date ?? "",
});

watch(
    filterForm,
    debounce(() => {
        router.get(route("posts.index"), filterForm, {
            replace: true,
            preserveState: true,
            preserveScroll: true,
        });
    }),
    1000
);
</script>
