<script setup>
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    rol_id: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('users.store'), {
        onError: (errors) => {
            console.log(errors);

            form.errors = errors;
        },
        onSuccess: () => {
            form.reset();
            form.clearErrors();
        },
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="mx-auto flex flex-col items-center justify-center px-6 py-8 md:h-screen lg:py-0">
            <h1>Crear usuario</h1>
            <div class="w-full rounded-lg bg-white shadow sm:max-w-md md:mt-0 xl:p-0 dark:border dark:border-gray-700 dark:bg-gray-800">
                <div class="space-y-4 p-6 sm:p-8 md:space-y-6">
                    <h1 class="text-xl leading-tight font-bold tracking-tight text-gray-900 md:text-2xl dark:text-white">Create an account</h1>
                    <form class="space-y-4 md:space-y-6" method="post">
                        <div>
                            <label for="name" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Your name</label>
                            <input
                                v-model="form.name"
                                type="text"
                                name="name"
                                id="name"
                                class="focus:ring-primary-600 focus:border-primary-600 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                placeholder="name@company.com"
                                required=""
                            />
                            <p class="text-xs text-red-600" v-if="form.errors && form.errors.name">
                                {{ form.errors.name }}
                            </p>
                        </div>
                        <div>
                            <label for="email" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                            <input
                                v-model="form.email"
                                type="email"
                                name="email"
                                id="email"
                                class="focus:ring-primary-600 focus:border-primary-600 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                placeholder="name@company.com"
                                required=""
                            />
                            <p class="text-xs text-red-600" v-if="form.errors && form.errors.name">
                                {{ form.errors.email }}
                            </p>
                        </div>
                        <div>
                            <select
                                v-model="form.rol_id"
                                id="role"
                                name="role"
                                class="focus:ring-primary-600 focus:border-primary-600 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                            >
                                <option selected>Choose a role</option>
                                <option value="1">Admin</option>
                                <option value="2">Worker</option>
                                <option value="3">Client</option>
                            </select>
                            <p class="text-xs text-red-600" v-if="form.errors && form.errors.name">
                                {{ form.errors.rol_id }}
                            </p>
                        </div>
                        <div>
                            <label for="password" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input
                                v-model="form.password"
                                type="password"
                                name="password"
                                id="password"
                                placeholder="••••••••"
                                class="focus:ring-primary-600 focus:border-primary-600 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                required=""
                            />
                            <p class="text-xs text-red-600" v-if="form.errors && form.errors.name">
                                {{ form.errors.password }}
                            </p>
                        </div>
                        <div>
                            <label for="password_confirmation" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"
                                >Confirm password</label
                            >
                            <input
                                v-model="form.password_confirmation"
                                type="password"
                                name="password_confirmation"
                                id="password_confirmation"
                                placeholder="••••••••"
                                class="focus:ring-primary-600 focus:border-primary-600 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                required=""
                            />
                            <p class="text-xs text-red-600" v-if="form.errors && form.errors.name">
                                {{ form.errors.password_confirmation }}
                            </p>
                        </div>
                        <button
                            @click.prevent="submit"
                            type="submit"
                            class="bg-blue-600 hover:bg-blue-700 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 w-full rounded-lg px-5 py-2.5 text-center text-sm font-medium text-white focus:ring-4 focus:outline-none"
                        >
                            Create an account
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>
