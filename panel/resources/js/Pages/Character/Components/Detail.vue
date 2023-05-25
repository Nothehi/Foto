<script setup>
import { IconReplace, IconPencil, IconDeviceFloppy, IconX } from '@tabler/icons-vue'
import { ref } from 'vue';
import { router } from '@inertiajs/vue3'
import Modal from '@/Components/Modal.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    character: {
        type: Object,
        required: true,
    }
})

const faceId = ref(null);
const name = ref(props.character.name);
const showChangeNameInput = ref(false)
const showChangeAvatarModal = ref(false);
const closeModal = () => {
    showChangeAvatarModal.value = false;
}

function changeAvatar() {
    router.put(route('characters.update', props.character.id), { face: faceId.value }, {
        onSuccess: (res) => closeModal()
    })
}

function changeName() {
    router.put(route('characters.update', props.character.id), { name: name.value }, {
        onSuccess: (res) => showChangeNameInput.value = false
    })
}
</script>

<template>
    <div class="flex flex-row mb-10">
        <div class="relative group">
            <img :src="`/storage/${character.avatar.image}`" :alt="character.name" class="rounded-lg w-20">
            <button @click="showChangeAvatarModal = true"
                class="opacity-0 group-hover:opacity-100 flex absolute top-0 w-full h-full bg-gray-400 bg-opacity-50 rounded-lg items-center justify-center transition-all ease-in-out">
                <IconReplace class="text-dark-600" />
            </button>
        </div>
        <h2 class="group text-2xl ml-4 text-gray-500 dark:text-dark-100 cursor-pointer" @click="showChangeNameInput = true">
            <span v-if="!showChangeNameInput">{{ character.name }}</span>
            <IconPencil class="hidden group-hover:inline-block mx-2" />
        </h2>
        <div v-if="showChangeNameInput" class="text-2xl text-gray-500 dark:text-dark-100">
            <TextInput v-if="showChangeNameInput" v-model="name" type="text" class="bg-dark-500 border-none" />
            <IconDeviceFloppy @click="changeName" class="mx-2 inline-block cursor-pointer" />
            <IconX @click="showChangeNameInput = false" class="inline-block cursor-pointer" />
        </div>
        <Modal :show="showChangeAvatarModal" @close="closeModal">
            <div class="p-6">
                <h2 class="text-lg font-medium text-white">
                    Choose your favorite face image
                </h2>

                <div class="grid grid-cols-5 gap-4 mt-4">
                    <template v-for="(face, idx) in character.faces">
                        <button class="rounded-lg focus:ring-4" @click="faceId = face.id">
                            <img class="w-full h-full rounded-lg" :src="`/storage/${face.image}`" alt="">
                        </button>
                    </template>
                </div>

                <div class="mt-6 flex justify-center">
                    <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

                    <PrimaryButton class="ml-3" @click="changeAvatar">
                        Change Avatar
                    </PrimaryButton>
                </div>
            </div>
        </Modal>
    </div>
</template>