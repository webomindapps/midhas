<template>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>
                    <a class="manual-add" @click="addRow">
                        <i class="fal fa-plus"></i>
                    </a>
                </th>
            </tr>
        </thead>
        <tbody>
            <input
                type="hidden"
                name="deleted_product_service"
                :value="JSON.stringify(deletedPrdServices)"
            />

            <tr v-for="(service, index) in prdServices" :key="index">
                <td>
                    <input
                        type="hidden"
                        name="product_service_id[]"
                        v-model="prdServices[index].id"
                    />

                    <input
                        type="text"
                        v-model="prdServices[index].title"
                        name="product_service_title[]"
                    />
                </td>
                <td>
                    <textarea
                        name="product_service_description[]"
                        v-model="prdServices[index].description"
                    ></textarea>
                </td>
                <td>
                    <input
                        type="text"
                        name="product_service_prices[]"
                        class="price"
                        v-model="prdServices[index].price"
                    />
                </td>
                <td>
                    <a class="manual-add" @click="deleteRow(index)">
                        <i class="fal fa-trash"></i>
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script setup>
import { onMounted, reactive, ref } from "vue";

const props = defineProps(["existing"]);

const prdServices = reactive([]);

const deletedPrdServices = reactive([]);

const addRow = () => {
    prdServices.push({
        id: null,
        title: "",
        description: "",
        price: 0,
    });
};

onMounted(() => {
    if (props.existing) {
        props.existing.map((existing) => {
            prdServices.push({
                id: existing.id,
                title: existing.title,
                description: existing.description,
                price: existing.price,
            });
        });
    }
});

const deleteRow = (index) => {
    if (confirm("Are you sure you want to delete this?")) {
        if (prdServices[index].id) {
            deletedPrdServices.push(prdServices[index].id);
        }
        prdServices.splice(index, 1);
    }
};
</script>
