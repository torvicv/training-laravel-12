<script setup>
import AppLayout from '@/layouts/AppLayout.vue';

    defineProps({
        user: {
            required: true,
            type: Object,
        },
    });

    const openOption = (option) => {
        const options = document.querySelectorAll('.option');
        options.forEach((opt) => {
            if (opt !== option) {
                opt.classList.add('hidden');
            }
        });
        document.getElementById(option).classList.remove('hidden');
    }
</script>
<template>
    <AppLayout>
        <section class="bg-white py-8 antialiased md:py-16 dark:bg-gray-900">
            <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
                <div class="gap-8 lg:flex">
                    <!-- Sidenav -->
                    <article
                        id="sidebar"
                        class="hidden h-full w-full shrink-0 overflow-y-auto border border-gray-200 bg-white p-3 shadow-sm lg:block lg:rounded-lg dark:border-gray-700 dark:bg-gray-800"
                    >
                        <button
                            id="dropdownUserNameButton"
                            data-dropdown-toggle="dropdownUserName1"
                            type="button"
                            class="dark:hover-bg-gray-700 mb-3 flex w-full items-center justify-between rounded-lg bg-white p-2 hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 focus:outline-none dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700"
                        >
                            <span class="sr-only">Open user menu</span>
                            <div class="flex w-full items-center justify-between">
                                <div class="flex items-center">
                                    <img
                                        src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/jese-leos.png"
                                        class="mr-3 h-8 w-8 rounded-md"
                                        alt="Bonnie avatar"
                                    />
                                    <div class="text-left">
                                        <div class="mb-0.5 leading-none font-semibold text-gray-900 dark:text-white">
                                            {{ user.name }} ({{ user.rol.name }})
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">{{ user.email }}</div>
                                    </div>
                                </div>
                                <svg
                                    class="h-5 w-5 text-gray-900 dark:text-white"
                                    aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="m8 15 4 4 4-4m0-6-4-4-4 4"
                                    />
                                </svg>
                            </div>
                        </button>
                        <!-- Dropdown menu -->
                        <div
                            id="dropdownUserName1"
                            class="z-10 hidden w-[294px] divide-y divide-gray-100 rounded bg-white shadow dark:divide-gray-600 dark:bg-gray-700"
                            data-popper-placement="bottom"
                        >
                            <a href="#" class="flex items-center rounded px-4 py-3 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <img src="https://flowbite.com/docs/images/logo.svg" class="mr-3 h-8 w-8 rounded" alt="Michael avatar" />
                                <div class="text-left">
                                    <div class="mb-0.5 leading-none font-semibold text-gray-900 dark:text-white">Flowbite LLC (Company)</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">company@flowbite.com</div>
                                </div>
                            </a>
                        </div>
                        <div class="mb-4 w-full border-y border-gray-100 py-4 dark:border-gray-700">
                            <ul class="grid grid-cols-3 gap-2">
                                <li>
                                    <button
                                        @click="() => openOption('profile')"
                                        type="button"
                                        class="group w-full bg-primary-50 hover:bg-primary-100 dark:bg-primary-900 dark:hover:bg-primary-800 flex flex-col items-center justify-center rounded-xl p-2.5"
                                    >
                                        <span
                                            class="bg-primary-100 group-hover:bg-primary-200 dark:bg-primary-800 dark:group-hover:bg-primary-700 mb-1 flex h-8 w-8 items-center justify-center rounded-full"
                                        >
                                            <svg
                                                class="text-primary-700 dark:text-primary-300 h-5 w-5"
                                                aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="24"
                                                height="24"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke="currentColor"
                                                    stroke-linecap="square"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M10 19H5a1 1 0 0 1-1-1v-1a3 3 0 0 1 3-3h2m10 1a3 3 0 0 1-3 3m3-3a3 3 0 0 0-3-3m3 3h1m-4 3a3 3 0 0 1-3-3m3 3v1m-3-4a3 3 0 0 1 3-3m-3 3h-1m4-3v-1m-2.121 1.879-.707-.707m5.656 5.656-.707-.707m-4.242 0-.707.707m5.656-5.656-.707.707M12 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"
                                                />
                                            </svg>
                                        </span>
                                        <span class="text-primary-700 dark:text-primary-300 text-sm font-medium">Profile</span>
                                    </button>
                                </li>
                                <li>
                                    <button
                                        @click="() => openOption('sales')"
                                        type="button"
                                        class="group w-full flex flex-col items-center justify-center rounded-xl bg-purple-50 p-2.5 hover:bg-purple-100 dark:bg-purple-900 dark:hover:bg-purple-800"
                                    >
                                        <span
                                            class="mb-1 flex h-8 w-8 items-center justify-center rounded-full bg-purple-100 group-hover:bg-purple-200 dark:bg-purple-800 dark:group-hover:bg-purple-700"
                                        >
                                            <svg
                                                class="h-5 w-5 text-purple-600 dark:text-purple-300"
                                                aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="24"
                                                height="24"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke="currentColor"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M10 21v-9m3-4H7.5a2.5 2.5 0 1 1 0-5c1.5 0 2.875 1.25 3.875 2.5M14 21v-9m-9 0h14v8a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1v-8ZM4 8h16a1 1 0 0 1 1 1v3H3V9a1 1 0 0 1 1-1Zm12.155-5c-3 0-5.5 5-5.5 5h5.5a2.5 2.5 0 0 0 0-5Z"
                                                />
                                            </svg>
                                        </span>
                                        <span class="text-sm font-medium text-purple-600 dark:text-purple-300">Ventas</span>
                                    </button>
                                </li>
                                <li>
                                    <button
                                        @click="() => openOption('settings')"
                                        type="button"
                                        class="group w-full flex flex-col items-center justify-center rounded-xl bg-teal-50 p-2.5 hover:bg-teal-100 dark:bg-teal-900 dark:hover:bg-teal-800"
                                    >
                                        <span
                                            class="mb-1 flex h-8 w-8 items-center justify-center rounded-full bg-teal-100 group-hover:bg-teal-200 dark:bg-teal-800 dark:group-hover:bg-teal-700"
                                        >
                                            <svg
                                                class="h-5 w-5 text-teal-600 dark:text-teal-300"
                                                aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="24"
                                                height="24"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke="currentColor"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M17 8H5m12 0a1 1 0 0 1 1 1v2.6M17 8l-4-4M5 8a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.6M5 8l4-4 4 4m6 4h-4a2 2 0 1 0 0 4h4a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1Z"
                                                />
                                            </svg>
                                        </span>
                                        <span class="text-sm font-medium text-teal-600 dark:text-teal-300">Settings</span>
                                    </button>
                                </li>
                            </ul>
                        </div>
                        <div class="option hidden flex justify-center w-full" id="profile">
                            <div class="flex w-3/5 gap-12 items-center overflow-hidden">
                                <div class="w-2/3 flex h-full flex-col flex-[1_1_100%] items-center divide-y-2 divide-gray-200 rounded-l-lg overflow-hidden">
                                    <div class="w-full">
                                        <div class="py-4 text-start ">
                                            <span class="font-semibold text-gray-900 dark:text-white">
                                                {{ user.name }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="w-full">
                                        <div class="py-4 text-start ">
                                            {{ user.email }}
                                        </div>
                                    </div>
                                    <div class="w-full">
                                        <div class="py-4 text-start ">
                                            {{ user.rol.name }}
                                        </div>
                                    </div>

                                </div>
                                <div class="w-1/3">
                                    <img src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/jese-leos.png" class="w-full h-auto rounded-r-lg" alt="Michael avatar" />
                                </div>
                            </div>
                        </div>
                        <div class="option hidden" id="sales">
                            Ventas
                        </div>
                        <div id="settings" class="option hidden">
                            Settings
                        </div>
                    </article>
                </div>
            </div>
        </section>
    </AppLayout>
</template>
