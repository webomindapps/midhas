<template>
    
    <div class="col-lg-12">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Products</th>
                    <th>
                        <a class="manual-add" @click="addRow">
                            <i class="fal fa-plus"></i>
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(pck, index) in packages" :key="index">
                    <input type="hidden" name="accessory_ids[]" v-model="pck.id" />
                    <input type="hidden" name="accessory_sku[]" v-model="pck.sku" />

                    <td>
                        <input type="text" name="accessory_name[]" v-model="pck.accessory_name" required />
                    </td>
                    <td class="width-50">
                        <select @change="handleCategories(index)" name="accessory_category_id[]"
                            v-model="pck.accessory_category_id">
                            <option value="">Select</option>
                            <option v-for="category in props.categories" :key="category.value" :value="category.value">
                                {{ category.label }}
                            </option>
                        </select>
                    </td>
                    <td class="width-50">
                        <select @change="handleSku(index)" name="accessory_product_id[]"
                            v-model="pck.accesory_product_id" required>
                            <option value="">Select</option>
                            <option v-for="product in pck.products" :key="product.value" :value="product.value">
                                {{ product.name }} ({{ product.label }})
                            </option>
                        </select>
                    </td>
                    <td>
                        <a class="manual-add" @click="deleteRow(index)">
                            <i class="fal fa-trash"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
            <input type="hidden" name="deleted_product_accessory_id" v-model="deletedIds" />
        </table>
    </div>
</template>

<script setup>
import { onMounted, reactive, ref } from "vue";
import axios from "axios";

const props = defineProps(["categories", "existing"]);

const packages = ref([]);
const deletedPackages = reactive([]);
const deletedIds = ref("");
let endpoint = window._url;

// -----------------------------
// Add new row
// -----------------------------
const addRow = () => {
    packages.value.push({
        id: "",
        accessory_name: "",
        accessory_category_id: "",
        accesory_product_id: "",
        sku: "",
        products: [],
        msrp: 0,
        selling_price: 0,
    });
};

// -----------------------------
// Load existing accessories
// -----------------------------
onMounted(async () => {
    if (props.existing && props.existing.length > 0) {
        for (const item of props.existing) {
            let index = packages.value.push({
                id: item.id,
                accessory_name: item.accessory_name,
                accessory_category_id: item.accessory_category_id,
                accesory_product_id: item.accesory_product_id,
                products: [],
                msrp: 0,
                selling_price: 0,
            }) - 1;

            await handleCategories(index, item.accesory_product_id);
        }
    }
});


const handleCategories = async (index, selectedProductId = null) => {
    let item = packages.value[index];
    let url = endpoint + "/admin/getProducts";

    if (!selectedProductId) {
        item.accesory_product_id = "";
        item.sku = "";
        item.msrp = 0;
        item.selling_price = 0;
    }

    try {
        const res = await axios.get(url, {
            params: { id: item.accessory_category_id },
        });

        item.products = res.data;

        if (selectedProductId) {
            let selectedProduct = item.products.find(
                (p) => p.value.toString() === selectedProductId.toString()
            );

            if (selectedProduct) {
                item.accesory_product_id = selectedProduct.value.toString();
                item.sku = selectedProduct.sku || "";
                item.msrp = selectedProduct.price;
                item.selling_price = selectedProduct.price;
            }
        }
    } catch (e) {
        console.error("error", e);
    }
};


const handleSku = (index) => {
    let item = packages.value[index];

    let product = item.products.find(
        (p) => p.value.toString() === item.accesory_product_id.toString()
    );

    if (product) {
        item.sku = product.sku || "";
        item.selling_price = product.price;
        item.msrp = product.price;
    }
};

// -----------------------------
// Delete row
// -----------------------------
const deleteRow = (index) => {
    if (confirm("Are you sure you want to delete this?")) {
        if (packages.value[index].id) {
            deletedPackages.push(packages.value[index].id);
            deletedIds.value = JSON.stringify(deletedPackages);
        }
        packages.value.splice(index, 1);
    }
};
</script>

<style scoped>
.width-50 {
    width: 33%;
}
</style>
