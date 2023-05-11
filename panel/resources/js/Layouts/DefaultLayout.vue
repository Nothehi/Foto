<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link, router } from '@inertiajs/vue3';
import { IconChevronRight, IconGripVertical, IconPlus, IconPhoto, IconTrash, IconPoint, IconAlbum, IconTags, IconMasksTheater } from '@tabler/icons-vue';

function upload(e) {
    router.post(route('photos.store'), { photo: e.target.files[0] }, {
        preserveScroll: true,
        onSuccess: (response) => console.log(response),
    });
}
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100 dark:bg-dark-600">
            <nav class="bg-white border-b-2 border-gray-100 dark:bg-dark-700 dark:border-dark-300">
                <div class="mx-auto px-4 sm:px-6 lg:px-12">
                    <div class="flex items-center justify-between h-14">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('dashboard')">
                                <ApplicationLogo class="block h-9 w-auto fill-current text-gray-800" />
                                </Link>
                            </div>
                        </div>

                        <div class="ml-3 relative">
                            <Dropdown align="right" width="48">
                                <template #trigger>
                                    <span class="inline-flex">
                                        <button type="button"
                                            class="inline-flex items-center p-0.5 border border-transparent text-sm leading-4 font-medium rounded-full text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150 dark:bg-dark-200">
                                            <img :src="`https://api.dicebear.com/5.x/initials/svg?seed=${$page.props.auth.user.name}`"
                                                :alt="`${$page.props.auth.user.name}`" width="35" height="35"
                                                class="rounded-full">
                                        </button>
                                    </span>
                                </template>

                                <template #content>
                                    <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                                    <DropdownLink :href="route('logout')" method="post" as="button">
                                        Log Out
                                    </DropdownLink>
                                </template>
                            </Dropdown>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main class="flex flex-row">
                <aside class="w-full h-screen sticky top-0 md:w-1/6 bg-white dark:bg-dark-500">
                    <section class="flex flex-col py-4 px-8 border-b border-dark-200">
                        <div class="flex flex-row items-center px-4 py-2">
                            <IconPhoto class="dark:text-white" size="20" />
                            <h3 class="font-medium dark:text-white ml-4">All photos</h3>
                        </div>

                        <ul class="space-y-1">
                            <li class="hover:bg-dark-200 rounded-lg">
                                <button class="flex flex-row items-center w-full px-4 py-2">
                                    <IconPoint class="text-gray-400" size="20" />
                                    <p class="text-gray-400 text-sm ml-4">Recent</p>
                                    <span class="text-gray-300 ml-auto mr-2 font-bold">1</span>
                                </button>
                            </li>
                            <li class="hover:bg-dark-200 rounded-lg">
                                <button class="flex flex-row items-center w-full px-4 py-2">
                                    <IconPoint class="text-gray-400" size="20" />
                                    <p class="text-gray-400 text-sm ml-4">Trash</p>
                                    <span class="text-gray-300 ml-auto font-bold">
                                        <IconTrash class="dark:text-white" size="20" />
                                    </span>
                                </button>
                            </li>
                        </ul>
                    </section>

                    <section class="flex flex-col py-4 px-8 border-b border-dark-200">
                        <div class="flex flex-row items-center px-4 py-2">
                            <IconAlbum class="dark:text-white" size="20" />
                            <h3 class="font-medium dark:text-white ml-4">Albums</h3>
                            <button class="bg-dark-200 rounded-md ml-auto p-0.5">
                                <IconPlus class="ml-auto dark:text-white" size="18" />
                            </button>
                        </div>

                        <ul class="space-y-1">
                            <li class="hover:bg-dark-200 rounded-lg">
                                <button class="flex flex-row items-center w-full px-4 py-2">
                                    <img src="https://api.dicebear.com/5.x/identicon/svg?seed=test1" alt="test" width="20"
                                        height="20" class="rounded-lg">
                                    <p class="text-gray-400 text-sm ml-4">Test 1</p>
                                    <span class="text-gray-300 ml-auto mr-2 font-bold">1</span>
                                </button>
                            </li>
                            <li class="relative">
                                <IconGripVertical class="absolute -left-6 top-2.5 text-gray-500" size="20" />
                                <button class="flex flex-row items-center w-full px-4 py-2 dark:bg-dark-200 rounded-lg">
                                    <img src="https://api.dicebear.com/5.x/identicon/svg?seed=test2" alt="test" width="20"
                                        height="20" class="rounded-lg">
                                    <p class="dark:text-white text-sm ml-4">Test 2</p>
                                    <IconChevronRight class="ml-auto dark:text-white" size="20" />
                                </button>
                            </li>
                            <li class="hover:bg-dark-200 rounded-lg">
                                <button class="flex flex-row items-center w-full px-4 py-2">
                                    <img src="https://api.dicebear.com/5.x/identicon/svg?seed=test3" alt="test" width="20"
                                        height="20" class="rounded-lg">
                                    <p class="text-gray-400 text-sm ml-4">Test 3</p>
                                    <span class="text-gray-300 ml-auto mr-2 font-bold">3</span>
                                </button>
                            </li>
                        </ul>
                    </section>

                    <section class="flex flex-col py-4 px-8">
                        <ul class="space-y-1">
                            <li class="hover:bg-dark-200 rounded-lg">
                                <button class="flex flex-row items-center w-full px-4 py-2">
                                    <span class="bg-rose-900 rounded-lg p-0.5">
                                        <IconTags class="text-rose-300" />
                                    </span>
                                    <p class="dark:text-white ml-2">Tags</p>
                                    <span class="text-gray-300 ml-auto mr-2 font-bold">5</span>
                                </button>
                            </li>
                            <li class="hover:bg-dark-200 rounded-lg">
                                <button class="flex flex-row items-center w-full px-4 py-2">
                                    <span class="bg-sky-900 rounded-lg p-0.5">
                                        <IconMasksTheater class="text-sky-300" />
                                    </span>
                                    <p class="dark:text-white ml-2">Persons</p>
                                    <span class="text-gray-300 ml-auto mr-2 font-bold">5</span>
                                </button>
                            </li>
                        </ul>
                    </section>

                    <section class="flex flex-col py-4 px-8">
                        <div
                            class="max-w-lg flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-dark-400 border-dashed rounded-md dark:bg-dark-700">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                    viewBox="0 0 48 48" aria-hidden="true">
                                    <path
                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="file-upload"
                                        class="relative cursor-pointer bg-white dark:bg-dark-400 rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                        <span>Upload a file</span>
                                        <input @change="upload" id="file-upload" name="file-upload" type="file"
                                            class="sr-only">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                            </div>
                        </div>
                    </section>
                </aside>

                <section class="hidden md:block w-5/6">
                    <slot />
                </section>
            </main>
        </div>
    </div>
</template>
