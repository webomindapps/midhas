<template>
    <div class="modal" :class="{ show: props.show }">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close" @click="hideModal">&times;</span>
            <slot></slot>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";

const props = defineProps(["show"]);
const emit = defineEmits(["show", "hide"]);

const showModal = () => {
    emit("show");
};

const hideModal = () => {
    emit("hide");
};
</script>

<style scoped>
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 999; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0, 0, 0); /* Fallback color */
    background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
}
.card-body{
    padding: 10px !important;
}
/* Modal Content */
.modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 25px;
    border: 1px solid #888;
    width: 40%;
}

/* The Close Button */

.show {
    display: block;
}

.hide {
    display: none;
}
.close {
    position: absolute;
    top: 10px;
    right: 10px;
    background-color: green;
    color: #fff;
    border-radius: 50px;
    height: 30px;
    width: 30px;
    display: flex;
    font-size: 20px;
    justify-content: center;
    align-items: center;
    z-index: 99;
    cursor: pointer;
}
@media screen and (max-width: 768px) {
    .modal-content {
        padding: 15px;
        width: 90%;
        margin: auto;
    }
}
</style>
