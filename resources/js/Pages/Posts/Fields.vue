<template>
    <div class="grid grid-cols-6 gap-4">
        <div class="col-span-6">
            <label class="label">Title</label>
            <input type="text" v-model="form.title" class="input" />
            <error v-if="form.errors.title" :error="form.errors.title" />
        </div>

        <div class="col-span-6">
            <label class="label">Content</label>
            <textarea
                v-model="form.content"
                class="input"
                maxlength="1000"
            ></textarea>
            <div class="text-gray-500 text-sm mt-1">
                Characters: {{ characterCount }}/1000
            </div>
            <error v-if="form.errors.content" :error="form.errors.content" />
        </div>

        <div class="col-span-6">
            <label class="label">Scheduled Time</label>
            <input
                type="datetime-local"
                v-model="form.scheduled_time"
                class="input"
            />
            <error
                v-if="form.errors.scheduled_time"
                :error="form.errors.scheduled_time"
            />
        </div>

        <div class="col-span-6">
            <label class="label">Image</label>
            <input type="file" @input="addFile" class="input" />
            <error v-if="form.errors.image" :error="form.errors.image" />
            <div>
                <img
                    v-if="form.image_url"
                    :src="form.image_url"
                    class="mt-2"
                    style="max-width: 200px"
                />
            </div>
        </div>
        <PlatformSelect :platforms="platforms" v-model="form.platforms" />
        <div
            v-for="(message, key) in Object.entries(form.errors).filter(
                ([key]) => key.startsWith('platforms')
            )"
            :key="key"
        >
            <error :error="message[1]" />
        </div>

        <div class="col-span-6 flex justify-center gap-2">
            <input type="submit" value="Publish\Schedule" class="btn" />
            <input
                type="submit"
                value="Draft"
                class="btn"
                @click.prevent="draft"
            />
        </div>
    </div>
</template>

<script setup>
import { computed } from "vue";
import Error from "@/Components/UI/Error.vue";
import PlatformSelect from "./PlatformSelect.vue";
let props = defineProps({
    form: Object,
    platforms: Array,
});
const characterCount = computed(() => props.form.content.length);

const addFile = (event) => {
    props.form.image = event.target.files[0];
};

const draft = () => {
    props.form.status = "0";
    if (props.form.id) {
        props.form.platforms = props.form.platforms.map((platform) =>
            typeof platform === "object" && platform.id ? platform.id : platform
        );
        props.form.post(route("posts.update", props.form.id), props.form, {
            preserveScroll: true,
            preserveState: true,
        });
    } else {
        props.form.post(route("posts.store"), props.form, {
            preserveScroll: true,
            preserveState: true,
        });
    }
};
</script>
