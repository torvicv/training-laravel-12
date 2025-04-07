<script setup>
import { useForm } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';

defineProps({
    users: {
        required: true,
        type: Object,
    },
});

const form = useForm({
    name: '',
    email: '',
    address: '',
    phone: '',
    user_id: '',
});

const submit = () => {
    form.post(route('companies.store'), {
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
    <AppLayout>
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
                            <label for="address" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Your address</label>
                            <input
                                v-model="form.address"
                                type="text"
                                name="address"
                                id="address"
                                class="focus:ring-primary-600 focus:border-primary-600 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                placeholder="name@company.com"
                                required=""
                            />
                            <p class="text-xs text-red-600" v-if="form.errors && form.errors.address">
                                {{ form.errors.address }}
                            </p>
                        </div>
                        <div>
                            <label for="address" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Your phone</label>
                            <input
                                v-model="form.phone"
                                type="tel"
                                name="phone"
                                id="phone"
                                class="focus:ring-primary-600 focus:border-primary-600 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                placeholder="name@company.com"
                                required=""
                            />
                            <p class="text-xs text-red-600" v-if="form.errors && form.errors.phone">
                                {{ form.errors.phone }}
                            </p>
                        </div>
                        <div>
                            <select
                                v-model="form.user_id"
                                id="user_id"
                                name="user_id"
                                class="focus:ring-primary-600 focus:border-primary-600 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                            >
                                <option selected>Choose a owner</option>
                                <option v-for="user in users" :value="user.id">{{ user.name }}</option>
                            </select>
                            <p class="text-xs text-red-600" v-if="form.errors && form.errors.user_id">
                                {{ form.errors.user_id }}
                            </p>
                        </div>
                        <button
                            @click.prevent="submit"
                            type="submit"
                            class="bg-blue-600 hover:bg-blue-700 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 w-full rounded-lg px-5 py-2.5 text-center text-sm font-medium text-white focus:ring-4 focus:outline-none"
                        >
                            Create a company
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</AppLayout>
</template>
