<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    characters: {
        type: Object,
        required: true,
    }
})
</script>

<template>
    <aside class="w-1/5 flex flex-col sticky top-5">
        <h3 class="text-dark-100 mb-4">Characters</h3>

        <ul class=" space-y-2">
            <li v-for="(character, idx) in characters" :key="idx">
                <Link :href="`?character=${character.key}`"
                    class="flex flex-row items-center hover:bg-dark-200 py-1 px-2 rounded-lg">
                <img :src="`/storage/${character.avatar.image}`" alt="test" width="35" height="35" class="rounded-lg">
                <p class="text-gray-400 font-medium ml-4">{{ character.name }}</p>
                </Link>
            </li>
        </ul>
    </aside>
</template>