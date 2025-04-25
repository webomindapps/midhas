<template>
    <div class="col-lg-12 mt-2 mb-2" id="form-group-default-size">
        <label for="product_size">Product Size</label>
        <input
            type="text"
            name="tv_size"
            placeholder=""
            v-model="defaultSize"
        />
    </div>
    <div class="col-lg-12">
        <h6>Related Sizes</h6>
        <table class="table">
            <thead>
                <tr>
                    <th>Size</th>
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
                    <input
                        type="hidden"
                        name="tv_size_ids[]"
                        v-model="packages[index].id"
                    />
                    <input
                        type="hidden"
                        name="tv_size_sku[]"
                        v-model="packages[index].sku"
                    />
                    <td>
                        <input
                            type="text"
                            name="tv_sizes[]"
                            v-model="packages[index].size"
                        />
                    </td>
                    <td class="width-50">
                        <select
                            @change="handleCategories(index)"
                            name="tv_size_category_id[]"
                            v-model="packages[index].category_id"
                        >
                            <option :value="null">Select</option>
                            <option
                                :value="category.value"
                                v-for="category in props.categories"
                                :key="category.value"
                            >
                                {{ category.label }}
                            </option>
                        </select>
                    </td>
                    <td class="width-50">
                        <select
                            @change="handleSku(index)"
                            name="tv_size_product_id[]"
                            v-model="packages[index].product_id"
                        >
                            <option :value="null">Select</option>
                            <option
                                :value="product.value"
                                v-for="product in packages[index].products"
                                :key="product.value"
                                v-html="
                                    product.name + ' (' + product.label + ')'
                                "
                            ></option>
                        </select>
                    </td>
                    <td>
                        <a class="manual-add" @click="deleteRow(index)">
                            <i class="fal fa-trash"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
            <input
                type="hidden"
                name="deleted_product_tv_sizes"
                v-model="deletedIds"
            />
        </table>
    </div>
</template>

<script setup>
import { onMounted, reactive, ref } from "vue";
import axios from "axios";

const props = defineProps(["categories", "existing", "size"]);

const defaultSize = ref("");
const packages = ref([]);

let endpoint = window._url;

const deletedPackages = reactive([]);
const deletedIds = ref("");

let state = packages.value;

const addRow = () => {
    packages.value.push({
        id: null,
        category_id: null,
        product_id: null,
        sku: "",
        size: "",
        products: [],
    });
};

onMounted(async () => {
    if (props.existing) {
        defaultSize.value = props.size;
        await props.existing.map((item) => {
            let index =
                packages.value.push({
                    id: item.id,
                    size: item.size,
                    category_id: item.size_category_id,
                    products: [],
                }) - 1;

            handleCategories(index);
            let statePackage = packages.value[index];
            statePackage.product_id = item.size_product_id;
            statePackage.sku = item.sku;
        });
    } else {
        // addRow();
    }
});

const handleCategories = (index) => {
    let item = state[index];
    let url = endpoint + "/admin/getProducts";

    item.product_id = null;
    item.sku = "";
    item.msrp = 0;
    item.selling_price = 0;

    axios
        .get(url, {
            params: {
                id: item.category_id,
            },
        })
        .then((res) => {
            item.products = res.data;
        })
        .catch((e) => {
            console.log("error", e);
        });
};

const handleSku = (index) => {
    let item = state[index];
    let productIndex = item.products.findIndex(
        (i) => i.value == item.product_id
    );
    if (productIndex > -1) {
        let product = item.products[productIndex];
        item.sku = product.label;
        item.selling_price = product.price;
        item.msrp = product.price;
    }
};

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
