<template>
    <div class="col-span-6">
        <label class="label">Platforms</label>
        <Multiselect
            v-model="selectedPlatforms"
            :options="platformOptions"
            :multiple="true"
            :close-on-select="false"
            placeholder="Select platforms"
            label="name"
            track-by="id"
            class="input"
        />
    </div>
</template>

<script setup>
import { ref, computed, watch, onMounted } from "vue";
import Multiselect from "vue-multiselect";
import "vue-multiselect/dist/vue-multiselect.css";

const props = defineProps({
    modelValue: Array,
    platforms: Array,
});

const emit = defineEmits(["update:modelValue"]);

const platformOptions = computed(() => props.platforms);

const selectedPlatforms = ref([...props.modelValue]);

watch(
    () => selectedPlatforms.value,
    (newValue) => {
        const ids = newValue.map((item) => item.id);
        emit("update:modelValue", ids);
    },
    { deep: true }
);
</script>
