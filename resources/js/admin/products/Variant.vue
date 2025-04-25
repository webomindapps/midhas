<template>
    <table class="table">
        <thead>
            <tr>
                <th>Type</th>
                <th>Value</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Image</th>
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
                name="deleted_variants"
                :value="JSON.stringify(deletedVariants)"
            />
            <tr v-for="(variant, index) in variantItems" :key="index">
                <td>
                    <input
                        type="hidden"
                        name="variant_id[]"
                        v-model="variantItems[index].id"
                    />
                    <select
                        name="variant_type_id[]"
                        v-model="variantItems[index].variant_type_id"
                    >
                        <option value="">Select</option>
                        <option
                            :value="type.value"
                            v-for="type in props.types"
                            :key="type.value"
                        >
                            {{ type.label }}
                        </option>
                    </select>
                </td>
                <td>
                    <input
                        type="text"
                        name="variant_value[]"
                        v-model="variantItems[index].value"
                        required
                    />
                </td>
                <td>
                    <input
                        type="text"
                        name="variant_price[]"
                        v-model="variantItems[index].price"
                        required
                    />
                </td>
                <td>
                    <input
                        name="variant_stock[]"
                        v-model="variantItems[index].stock"
                        required
                    />
                </td>
                <td>
                    <input
                        type="file"
                        name="variant_files[]"
                        :required="!variantItems[index].id"
                    />
                    <p class="text-center mt-2">
                        <a
                            v-if="variantItems[index].file"
                            :href="`${assetUrl}storage/${variantItems[index].file}`"
                            target="_blank"
                            >View</a
                        >
                    </p>
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
import { onMounted, reactive } from "vue";

const props = defineProps(["types", "existing"]);

const variantItems = reactive([]);
const deletedVariants = reactive([]);

let assetUrl = window._asset;

onMounted(() => {
    if (props.existing) {
        props.existing.map((existing) => {
            variantItems.push({
                id: existing.id,
                variant_type_id: existing.variant_id,
                value: existing.value,
                price: existing.price,
                image: null,
                stock: existing.stock,
                file: existing.thumbnail,
            });
        });
    }
});

const addRow = () => {
    variantItems.push({
        id: null,
        variant_type_id: "",
        value: "",
        price: 0,
        image: null,
        stock: 0,
        file: null,
    });
};

const deleteRow = (index) => {
    if (confirm("Are you sure you want to delete this?")) {
        if (variantItems[index].id) {
            deletedVariants.push(stockItems[index].id);
        }
        variantItems.splice(index, 1);
    }
};
</script>
