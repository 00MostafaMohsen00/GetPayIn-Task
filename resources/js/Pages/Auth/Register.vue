<template>
    <form @submit.prevent="register">
        <div class="w-1/2 mx-auto">
            <div>
                <label for="name" class="label">Name</label>
                <input
                    id="name"
                    type="text"
                    v-model="form.name"
                    required
                    class="input"
                />
                <error v-if="form.errors.name" :error="form.errors.name" />
            </div>
            <div>
                <label for="email" class="label">Email</label>
                <input
                    id="email"
                    type="email"
                    v-model="form.email"
                    required
                    class="input"
                />
                <error v-if="form.errors.email" :error="form.errors.email" />
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
            <div class="mt-4">
                <label for="password_confirmation" class="label">
                    Confirm Password
                </label>
                <input
                    id="password_confirmation"
                    type="password"
                    v-model="form.password_confirmation"
                    required
                    class="input"
                />
                <error
                    v-if="form.errors.password_confirmation"
                    :error="form.errors.password_confirmation"
                />
            </div>
            <div class="my-4 flex flex-col">
                <Link :href="route('login')" class="mb-4 text-sm text-blue-600"
                    >Have Account</Link
                >
                <input type="submit" value="Sign Up" class="btn w-full" />
            </div>
        </div>
    </form>
</template>
<script setup>
import Error from "@/Components/UI/Error.vue";
import { useForm } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
const form = useForm({
    name: null,
    email: null,
    password: null,
    password_confirmation: null,
});
const register = () => {
    form.post(route("register.save"), {
        preserveScroll: true,
        preserveState: true,
    });
};
</script>
