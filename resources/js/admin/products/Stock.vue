<template>
    <div class="col-lg-6 mb-4">
        <label for="">Overall Stock</label>
        <input type="number" name="total_stock" v-model="allStock" />
    </div>
    <div class="col-lg-12">
        <table class="table">
            <thead>
                <tr>
                    <th>Store</th>
                    <th>Stock</th>
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
                    name="deleted_stocks"
                    :value="JSON.stringify(deletedStocks)"
                />

                <tr v-for="(stock, index) in stockItems" :key="index">
                    <td>
                        <input
                            type="hidden"
                            name="stock_id[]"
                            v-model="stockItems[index].id"
                        />
                        <select
                            name="stores[]"
                            v-model="stockItems[index].store_id"
                        >
                            <option value="">Select</option>
                            <option
                                :value="store.value"
                                v-for="store in props.stores"
                                :key="store.value"
                            >
                                {{ store.label }}
                            </option>
                        </select>
                    </td>
                    <td>
                        <input
                            type="number"
                            name="stock[]"
                            v-model="stockItems[index].stock"
                            @change="handleStockChange(index)"
                            required
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
    </div>
</template>

<script setup>
import { onMounted, reactive, ref } from "vue";

const props = defineProps(["stores", "existing", "stock"]);

const allStock = ref(0);
const stockItems = reactive([]);

const deletedStocks = reactive([]);

onMounted(() => {});

const addRow = () => {
    stockItems.push({
        id: null,
        store_id: "",
        stock: 0,
    });
};

onMounted(() => {
    if (props.existing) {
        allStock.value = props.stock;
        props.existing.map((existing) => {
            stockItems.push({
                id: existing.id,
                store_id: existing.store_id,
                stock: existing.balance,
            });
        });
    }
});

const deleteRow = (index) => {
    if (confirm("Are you sure you want to delete this?")) {
        if (stockItems[index].id) {
            deletedStocks.push(stockItems[index].id);
        }
        stockItems.splice(index, 1);
    }
};

const handleStockChange = (index) => {
    var stock = 0;

    stockItems.map((item) => {
        stock += item.stock;
    });

    if (stock > allStock.value) {
        alert("Stock cannot be more than the available stock");
        stockItems[index].stock = 0;
    }
};
</script>
