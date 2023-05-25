<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import { IconChevronLeft, IconTrash } from '@tabler/icons-vue'
import Characters from './../Dashboard/Components/Characters.vue'
import Detail from './Components/Detail.vue'
import PhotoCard from './../Dashboard/Components/PhotoCard.vue'

const props = defineProps({
    photos: {
        type: Object,
        required: true
    },
    characters: {
        type: Object,
        required: true
    },
    album: {
        type: Object,
        required: false,
        default: null
    }
})

function destroy() {
    if (confirm('Are you sure?')) {
        router.delete(route('albums.destroy', props.album.id))
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


                    <Detail :album="album" />

                    <div v-for="(item, date) in photos" :key="date" class="mb-10">
                        <h3 class="text-dark-100">{{ date }}</h3>

                        <div class="columns-3 mt-4">
                            <div v-for="(photo, idx) in item" :key="idx"
                                class="w-full h-full rounded-lg py-1.5 inline-block">
                                <Link :href="route('photos.show', photo.id)">
                                <PhotoCard :photo="photo" />
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>

                <Characters :characters="characters" />
            </div>
        </div>
    </DefaultLayout>
</template>
