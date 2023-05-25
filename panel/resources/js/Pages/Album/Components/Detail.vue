<script setup>
import { IconPencil, IconDeviceFloppy, IconX } from '@tabler/icons-vue'
import { ref } from 'vue';
import { router } from '@inertiajs/vue3'
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    album: {
        type: Object,
        required: true,
    }
})

const name = ref(props.album.name);
const showChangeNameInput = ref(false)

function changeName() {
    router.put(route('albums.update', props.album.id), { name: name.value }, {
        onSuccess: (res) => showChangeNameInput.value = false
    })
}
</script>

<template>
    <div class="flex flex-row mb-10">
        <div class="relative">
            <img :src="`https://api.dicebear.com/5.x/identicon/svg?seed=${album.name}`" :alt="album.name"
                class="rounded-lg w-20">
        </div>
        <h2 class="group text-2xl ml-4 text-gray-500 dark:text-dark-100 cursor-pointer" @click="showChangeNameInput = true">
            <span v-if="!showChangeNameInput">{{ album.name }}</span>
            <IconPencil class="hidden group-hover:inline-block mx-2" />
        </h2>
        <div v-if="showChangeNameInput" class="text-2xl text-gray-500 dark:text-dark-100">
            <TextInput v-if="showChangeNameInput" v-model="name" type="text" class="bg-dark-500 border-none" />
            <IconDeviceFloppy @click="changeName" class="mx-2 inline-block cursor-pointer" />
            <IconX @click="showChangeNameInput = false" class="inline-block cursor-pointer" />
        </div>
    </div>
</template>