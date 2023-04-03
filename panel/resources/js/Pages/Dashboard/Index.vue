<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { IconReplace, IconChevronLeft, IconPencil } from '@tabler/icons-vue'
import Characters from './Components/Characters.vue'
import CharacterDetail from './Components/CharacterDetail.vue'
import PhotoCard from './Components/PhotoCard.vue'

defineProps({
    photos: {
        type: Object,
        required: true
    },
    characters: {
        type: Object,
        required: true
    },
    character: {
        type: Object,
        required: false,
        default: null
    }
})
</script>

<template>
    <Head title="Dashboard" />

    <DefaultLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-row">
                <div class="w-4/5 flex flex-col">
                    <div v-if="character">
                        <Link :href="route('dashboard')"
                            class="inline-block mb-1 p-1 rounded-lg bg-dark-400 hover:bg-dark-300">
                        <IconChevronLeft class="text-dark-100" />
                        </Link>
                    </div>

                    <CharacterDetail v-if="character" :character="character" />

                    <template v-for="(item, date) in photos" :key="date">
                        <h3 class="text-dark-100">{{ date }}</h3>

                        <div class="columns-3 mt-4">
                            <div v-for="(photo, idx) in item" :key="idx"
                                class="w-full h-full rounded-lg py-1.5 inline-block">
                                <PhotoCard :photo="photo" />
                            </div>
                        </div>
                    </template>
                </div>

                <Characters :characters="characters" />
            </div>
        </div>
    </DefaultLayout>
</template>
