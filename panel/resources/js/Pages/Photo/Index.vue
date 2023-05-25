<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { onMounted, ref } from 'vue';
import { IconChevronLeft, IconTrash, IconX, IconPlus } from '@tabler/icons-vue'
import Dropdown from '@/Components/Dropdown.vue';

const props = defineProps({
    photo: {
        type: Object,
        required: true
    },
    albums: {
        type: Object,
        required: true
    }
})

const image = ref(null)
const size = ref([])

onMounted(() => {
    setTimeout(() => {
        size.value = [image.value.naturalWidth, image.value.naturalHeight]
    }, 100)
})

function destroy() {
    if (confirm('Are you sure?')) {
        router.delete(route('photos.destroy', props.photo.id))
    }
}

function addPhotoToAlbum(albumId) {
    router.post(route('albums.photos.store', { album: albumId }), { photo: props.photo.id })
}

function removePhotoInAllbum(albumId) {
    if (confirm('Are you sure?')) {
        router.delete(route('albums.photos.destroy', { album: albumId, photo: props.photo.id }))
    }
}
</script>

<template>
    <Head title="Dashboard" />

    <DefaultLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-row">
                <div class="w-4/5 flex flex-col pr-10">
                    <div class="flex flex-row items-center mb-2 space-x-2">
                        <Link :href="route('dashboard')"
                            class="inline-block mb-1 p-1 rounded-lg bg-dark-400 hover:bg-dark-300">
                        <IconChevronLeft class="text-dark-100" />
                        </Link>

                        <button @click="destroy" class="inline-block mb-1 p-1 rounded-lg bg-red-900 hover:bg-rose-800">
                            <IconTrash class="text-rose-300" />
                        </button>
                    </div>

                    <img :src="`/storage/${photo.path}`" :alt="photo.name" ref="image" class="rounded-lg">

                    <ul class="flex felx-row space-x-4 mt-6">
                        <template v-for="face in photo.faces">
                            <li class="hover:bg-dark-400 p-1 rounded-lg" v-if="face.character">
                                <Link :href="route('characters.show', face.character.id)"
                                    class="flex flex-row items-center space-x-2">
                                <img :src="`/storage/${face.image}`" :alt="face.character.name" class="w-16 rounded-lg">
                                <p class="text-dark-100 text-sm">{{ face.character.name }}</p>
                                </Link>
                            </li>
                        </template>
                    </ul>
                </div>

                <div class="w-1/5 flex flex-col sticky top-5 mt-8">
                    <ul class="space-y-4">
                        <li>
                            <p class="font-medium dark:text-white text-lg">Name</p>
                            <span class="text-gray-400 text-sm">{{ photo.name }}</span>
                        </li>
                        <li>
                            <p class="font-medium dark:text-white text-lg">Size</p>
                            <span class="text-gray-400 text-sm">{{ size[0] }} x {{ size[1] }}</span>
                        </li>
                        <li>
                            <p class="font-medium dark:text-white text-lg">Albums</p>
                            <div class="flex items-center space-x-2">
                                <template v-for="album in photo.albums">
                                    <div
                                        class="text-gray-400 text-sm py-1 px-2 bg-dark-200 rounded-lg inline-flex flex-row items-center">
                                        <p>{{ album.name }}</p>
                                        <button @click="() => removePhotoInAllbum(album.id)" class="ml-1">
                                            <IconX class="w-4" />
                                        </button>
                                    </div>
                                </template>
                                <div
                                    class="text-gray-400 text-sm py-1 px-2 bg-dark-200 rounded-lg inline-flex flex-row items-center">
                                    <Dropdown align="right" width="48">
                                        <template #trigger>
                                            <button>
                                                <IconPlus class="w-4" />
                                            </button>
                                        </template>

                                        <template #content>
                                            <template v-for="album in albums">
                                                <button @click="() => addPhotoToAlbum(album.id)"
                                                    class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-500 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                                                    {{ album.name }}
                                                </button>
                                            </template>
                                        </template>
                                    </Dropdown>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </DefaultLayout>
</template>
