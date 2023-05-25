<script setup>
import { computed, ref } from 'vue';
import { usePage, router, Link } from '@inertiajs/vue3';
import { IconChevronRight, IconGripVertical, IconPlus, IconPhoto, IconTrash, IconPoint, IconAlbum } from '@tabler/icons-vue';
import Modal from '@/Components/Modal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const recents = computed(() => usePage().props.auth.recents)
const albums = computed(() => usePage().props.auth.albums)

const name = ref(null)
const showModal = ref(false);
const closeModal = () => { name.value = null; showModal.value = false }

function newAlbum() {
    router.post(route('albums.store'), { name: name.value }, {
        onSuccess: () => closeModal
    })
}

function upload(e) {
    router.post(route('photos.store'), { photo: e.target.files[0] }, {
        preserveScroll: true,
    });
}
</script>

<template>
    <aside class="w-full h-screen sticky top-0 md:w-1/6 bg-white dark:bg-dark-500">
        <section class="flex flex-col py-4 px-8 border-b border-dark-200">
            <div class="flex flex-row items-center px-4 py-2">
                <IconPhoto class="dark:text-white" size="20" />
                <h3 class="font-medium dark:text-white ml-4">Recent photos</h3>
            </div>

            <ul class="space-y-1">
                <li class="hover:bg-dark-200 rounded-lg">
                    <Link :href="route('dashboard', { recent: 'month' })"
                        class="flex flex-row items-center w-full px-4 py-2">
                    <IconPoint class="text-gray-400" size="20" />
                    <p class="text-gray-400 text-sm ml-4">Month</p>
                    <span class="text-gray-300 ml-auto mr-2 font-bold">{{ recents.month }}</span>
                    </Link>
                </li>
                <li class="hover:bg-dark-200 rounded-lg">
                    <Link :href="route('dashboard', { recent: 'week' })"
                        class="flex flex-row items-center w-full px-4 py-2">
                    <IconPoint class="text-gray-400" size="20" />
                    <p class="text-gray-400 text-sm ml-4">Week</p>
                    <span class="text-gray-300 ml-auto mr-2 font-bold">{{ recents.week }}</span>
                    </Link>
                </li>
                <li class="hover:bg-dark-200 rounded-lg">
                    <Link :href="route('dashboard', { recent: 'day' })" class="flex flex-row items-center w-full px-4 py-2">
                    <IconPoint class="text-gray-400" size="20" />
                    <p class="text-gray-400 text-sm ml-4">Day</p>
                    <span class="text-gray-300 ml-auto mr-2 font-bold">{{ recents.day }}</span>
                    </Link>
                </li>
                <!-- <li class="hover:bg-dark-200 rounded-lg">
                    <button class="flex flex-row items-center w-full px-4 py-2">
                        <IconPoint class="text-gray-400" size="20" />
                        <p class="text-gray-400 text-sm ml-4">Trash</p>
                        <span class="text-gray-300 ml-auto font-bold">
                            <IconTrash class="dark:text-white" size="20" />
                        </span>
                    </button>
                </li> -->
            </ul>
        </section>

        <section class="flex flex-col py-4 px-8 border-b border-dark-200">
            <div class="flex flex-row items-center px-4 py-2">
                <IconAlbum class="dark:text-white" size="20" />
                <h3 class="font-medium dark:text-white ml-4">Albums</h3>
                <button @click="showModal = true" class="bg-dark-200 rounded-md ml-auto p-0.5">
                    <IconPlus class="ml-auto dark:text-white" size="18" />
                </button>

                <Modal :show="showModal" @close="closeModal">
                    <div class="p-6 flex flex-col">
                        <h2 class="text-lg font-medium text-white">
                            Enter name of album:
                        </h2>

                        <TextInput v-model="name" type="text" class="bg-dark-300 text-white border-none" />

                        <div class="mt-6 flex justify-center">
                            <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

                            <PrimaryButton class="ml-3" @click="newAlbum">
                                Store
                            </PrimaryButton>
                        </div>
                    </div>
                </Modal>
            </div>

            <ul class="space-y-1">
                <template v-for="album in albums">
                    <li v-if="route().current('albums.show', album.id)" class="relative">
                        <IconGripVertical class="absolute -left-6 top-2.5 text-gray-500" size="20" />
                        <button class="flex flex-row items-center w-full px-4 py-2 dark:bg-dark-200 rounded-lg">
                            <img :src="`https://api.dicebear.com/5.x/identicon/svg?seed=${album.name}`" :alt="album.name"
                                width="20" height="20" class="rounded-lg">
                            <p class="dark:text-white text-sm ml-4">{{ album.name }}</p>
                            <IconChevronRight class="ml-auto dark:text-white" size="20" />
                        </button>
                    </li>
                    <li v-else class="hover:bg-dark-200 rounded-lg">
                        <Link :href="route('albums.show', album.id)">
                        <button class="flex flex-row items-center w-full px-4 py-2">
                            <img :src="`https://api.dicebear.com/5.x/identicon/svg?seed=${album.name}`" :alt="album.name"
                                width="20" height="20" class="rounded-lg">
                            <p class="text-gray-400 text-sm ml-4">{{ album.name }}</p>
                            <span class="text-gray-300 ml-auto mr-2 font-bold">{{ album.photos_count }}</span>
                        </button>
                        </Link>
                    </li>
                </template>
            </ul>
        </section>

        <!-- <section class="flex flex-col py-4 px-8">
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
        </section> -->

        <section class="flex flex-col py-4 px-8">
            <div
                class="max-w-lg flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-dark-400 border-dashed rounded-md dark:bg-dark-700">
                <div class="space-y-1 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48"
                        aria-hidden="true">
                        <path
                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="flex text-sm text-gray-600 flex-col items-center">
                        <label for="file-upload"
                            class="relative cursor-pointer bg-white dark:bg-dark-400 rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                            <span>Upload a file</span>
                            <input @change="upload" id="file-upload" name="file-upload" type="file" class="sr-only">
                        </label>
                        <!-- <p class="pl-1">or drag and drop</p> -->
                    </div>
                    <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                </div>
            </div>
        </section>
    </aside>
</template>
