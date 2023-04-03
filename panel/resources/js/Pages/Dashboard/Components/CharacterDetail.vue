<script setup>
import { IconReplace, IconPencil } from '@tabler/icons-vue'

defineProps({
    character: {
        type: Object,
        required: true,
    }
})
</script>

<template>
    <div class="flex flex-row mb-10">
        <div class="relative group">
            <img :src="`/storage/${character.avatar.image}`" :alt="character.name" class="rounded-lg w-20">
            <button
                class="opacity-0 group-hover:opacity-100 flex absolute top-0 w-full h-full bg-gray-400 bg-opacity-50 rounded-lg items-center justify-center transition-all ease-in-out">
                <IconReplace class="text-dark-600" />
            </button>
        </div>
        <h2 class="group text-2xl ml-4 text-gray-500 dark:text-dark-100">
            {{ character.name }}
            <IconPencil class="hidden group-hover:inline-block cursor-pointer" />
        </h2>
    </div>
</template>