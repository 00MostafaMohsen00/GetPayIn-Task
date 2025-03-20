<template>
    <header
        class="border-b bg-white bordeer-gray-200 dark:border-gray-700 dark:bg-gray-800 w-full sticky top-0 z-50"
    >
        <div class="container mx-auto">
            <nav class="p-4 flex justify-between items-center">
                <div class="text-lg font-medium">
                    <Link :href="route('posts.index')" class="btn-outline">
                        <i class="fas fa-home"></i>
                    </Link>
                </div>
                <div
                    class="text-xl text-indigo-600 dark:text-indigo-300 font-bold text-center"
                >
                    <Link href="/">{{ app_name }}</Link>
                </div>

                <div class="flex items-center gap-4">
                    <button
                        class="btn-outline flex flex-col gap-0 w-8 relative"
                        @click="isMainMenuOpen = !isMainMenuOpen"
                    >
                        <span v-for="i in 3" :key="i" class="btn-border"></span>
                    </button>
                    <transition>
                        <div
                            v-if="isMainMenuOpen"
                            class="ltr:origin-top-right rtl:origin-top-left rtl:left-10 absolute ltr:right-10 top-20 mt-2 w-56 rounded-md shadow-lg border border-md bg-white bordeer-gray-200 dark:border-gray-700 dark:bg-gray-800 flex flex-col justify-center align-center z-10 p-2"
                        >
                            <button
                                @click.prevent="toggleDark"
                                class="menu-item"
                            >
                                <i :class="emoji"></i>
                            </button>
                            <div v-if="user" class="flex flex-col gap-1">
                                <Link
                                    :href="route('profile')"
                                    class="menu-item text-center"
                                    ><div class="text-sm text-gray-500">
                                        {{ user.name }}
                                    </div>
                                </Link>

                                <Link
                                    :href="route('posts.create')"
                                    class="menu-item text-center"
                                >
                                    <i class="fas fa-plus"></i>
                                </Link>
                                <Link
                                    class="menu-item text-center"
                                    :href="route('logout')"
                                    method="delete"
                                    as="button"
                                >
                                    <i class="fa fa-arrow-right"></i>
                                </Link>
                            </div>
                            <div v-else class="flex items-center gap-4">
                                <Link
                                    :href="route('login')"
                                    class="menu-item text-center"
                                >
                                    <i class="fa fa-arrow-left"></i>
                                </Link>
                            </div>
                        </div>
                    </transition>
                </div>
            </nav>
        </div>
    </header>
</template>
<script setup>
import { Link, usePage } from "@inertiajs/vue3";
import { computed, onMounted, ref, onBeforeMount } from "vue";
const page = usePage();
const user = computed(() => page.props.user);

const isDark = ref(false);

onMounted(() => {
    if (localStorage.getItem("isDark") === "true") {
        isDark.value = true;
        document.documentElement.classList.add("dark");
    } else {
        document.documentElement.classList.remove("dark");
        isDark.value = false;
    }
});

const toggleDark = () => {
    isDark.value = !isDark.value;
    document.documentElement.classList.toggle("dark");
    localStorage.setItem("isDark", isDark.value);
};

const emoji = computed(() => (isDark.value ? "fa fa-sun" : "fa fa-moon"));

const isMainMenuOpen = ref(false);
onBeforeMount(() => {
    // Add event listener to close the menu when the user clicks outside of the menu
    window.addEventListener("click", (event) => {
        if (!event.target.classList.contains("btn-outline")) {
            isMainMenuOpen.value = false;
        }
    });
    window.addEventListener("scroll", () => {
        isMainMenuOpen.value = false;
    });
});

const app_name = computed(() => {
    return import.meta.env.VITE_APP_NAME;
});
</script>
