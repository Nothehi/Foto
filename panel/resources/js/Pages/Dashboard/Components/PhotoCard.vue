<script setup>
import { ref, onMounted } from 'vue';

const props = defineProps({
    photo: {
        type: Object,
        required: true
    }
})

const image = ref(null)
const coordinates = ref([])
const visibleImage = ref(null)

onMounted(() => {
    setTimeout(() => {
        props.photo.faces.forEach(face => {
            coordinates.value.push([
                scaleX(face.coordinate[3]), scaleY(face.coordinate[0]),
                scaleX(face.coordinate[1]), scaleY(face.coordinate[2]),
            ])
        })
    }, 1000);
})

function scaleX(point) {
    return (image.value.width * point) / image.value.naturalWidth
}

function scaleY(point) {
    return (image.value.height * point) / image.value.naturalHeight
}

function showFace(idx) {
    visibleImage.value = idx
}

function isVisible(idx) {
    return visibleImage.value == idx
}

</script>

<template>
    <div class="relative">
        <img :src="`/storage/${photo.path}`" class="rounded-lg" ref="image" :usemap="`#${photo.id}`">
        <map :name="photo.id">
            <template v-for="(coords, idx) in coordinates" :key="idx">
                <template v-if="photo.faces[idx]?.character?.key">
                    <area @mouseover="showFace(idx)" @mouseout="visibleImage = null" shape="rect" :coords="coords"
                        :href="`?character=${photo.faces[idx]?.character?.key}`">
                </template>
            </template>
        </map>
        <template v-for="(face, idx) in photo.faces" :key="idx">
            <img v-if="isVisible(idx)" :src="`/storage/${face.image}`" width="80" height="80" class="absolute top-0" />
        </template>
    </div>
</template>