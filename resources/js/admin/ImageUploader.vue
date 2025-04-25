<template>
    <Uploader
        :server="`${URL}/api/upload-images`"
        @change="changeMedia"
        :max="max ? max : 1"
        :media="updateMedia.saved"
        @add="addMedia"
        @remove="removeMedia"
        :location="URL"
    >
    </Uploader>
</template>

<script setup>
import { onMounted, ref } from "vue";
import Uploader from "vue-media-upload";

const props = defineProps(["existing", "max", "extMultiple"]);

const URL = window._url;

const media = ref([]);

const updateMedia = ref({
    saved: [],
    added: [],
    removed: [],
});

const changeMedia = (media) => {
    media.value = media;
};

const addMedia = (addedImage, addedMedia) => {
    updateMedia.value.added = addedMedia;
};

const removeMedia = (removedImage, removedMedia) => {
    updateMedia.value.removed = removedMedia;
};

onMounted(() => {
    if (props.existing) {
        updateMedia.value.saved.push({
            id: props.existing.id,
            name: "storage/" + props.existing.url,
        });
    }

    if (props.extMultiple) {
        console.log("type", typeof props.extMultiple, props.extMultiple);
        props.extMultiple.map((item) => {
            updateMedia.value.saved.push({
                id: item.id,
                name: "storage/" + item.url,
            });
        });
    }
});
</script>
