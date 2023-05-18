<script setup>
import Sidebar from './Components/Sidebar.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import { Link } from '@inertiajs/vue3';
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
                <Sidebar />

                <section class="hidden md:block w-5/6">
                    <slot />
                </section>
            </main>
        </div>
    </div>
</template>
