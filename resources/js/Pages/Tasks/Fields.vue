<template>
    <div class="grid grid-cols-6 gap-4">
        <div class="col-span-6">
            <label class="label">Title</label>
            <input type="text" v-model="form.title" class="input" />
            <error v-if="form.errors.title" :error="form.errors.title" />
        </div>

        <div class="col-span-6">
            <label class="label">Description</label>
            <textarea v-model="form.description" class="input"></textarea>
            <error
                v-if="form.errors.description"
                :error="form.errors.description"
            />
        </div>

        <div class="col-span-6">
            <label class="label">Due Date</label>
            <input type="date" v-model="form.due_date" class="input" />
            <error v-if="form.errors.due_date" :error="form.errors.due_date" />
        </div>

        <div class="col-span-6">
            <label class="label">Category</label>
            <select v-model="form.category_id" class="input">
                <option
                    v-for="category in categories"
                    :key="category.id"
                    :value="category.id"
                >
                    {{ category.name }}
                </option>
            </select>
            <error
                v-if="form.errors.category_id"
                :error="form.errors.category_id"
            />
        </div>

        <div class="col-span-6">
            <input type="submit" value="Save" class="btn" />
        </div>
    </div>
</template>

<script setup>
import Error from "@/Components/UI/Error.vue";
defineProps({
    form: Object,
    categories: Array,
});
</script>
