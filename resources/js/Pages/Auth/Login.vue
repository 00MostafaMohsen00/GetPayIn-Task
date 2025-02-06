<template>
    <form @submit.prevent="save">
        <div class="w-1/2 mx-auto">
            <div>
                <label for="email" class="label">Email</label>
                <input
                    id="email"
                    type="email"
                    v-model="form.email"
                    required
                    class="input"
                />
                <error v-if="error" :error="error" />
            </div>
            <div class="mt-4">
                <label for="password" class="label">Password</label>
                <input
                    id="password"
                    type="password"
                    v-model="form.password"
                    required
                    class="input"
                />
                <error
                    v-if="form.errors.password"
                    :error="form.errors.password"
                />
            </div>
            <div class="mt-4 flex flex-col">
                <Link
                    :href="route('register')"
                    class="mb-4 text-sm text-blue-600"
                    >Dont Have Account
                </Link>
                <input type="submit" value="Login" class="btn w-full" />
            </div>
        </div>
    </form>
</template>
<script setup>
import Error from "@/Components/UI/Error.vue";
import { useForm, usePage } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
import { computed } from "vue";
const form = useForm({
    email: null,
    password: null,
});
const page = usePage();
const error = computed(() => {
    return form.errors.email
        ? form.errors.email
        : page.props.errors
        ? page.props.errors.email
        : null;
});
const save = () => {
    form.post(route("login.save"), {
        preserveScroll: true,
        preserveState: true,
    });
};
</script>
