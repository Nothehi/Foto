<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import Characters from './Components/Characters.vue'
import PhotoCard from './Components/PhotoCard.vue'

defineProps({
    photos: {
        type: Object,
        required: true
    },
    characters: {
        type: Object,
        required: true
    }
})
</script>

<template>
    <Head title="Dashboard" />

    <DefaultLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-row">
                <div class="w-4/5 flex flex-col pr-10">
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
