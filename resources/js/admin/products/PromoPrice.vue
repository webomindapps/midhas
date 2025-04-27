<template>
    <table class="table">
        <thead>
            <tr>
                <th>Price</th>
                <th>Start Date</th>
                <th>End Date</th>
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
                name="deleted_prices"
                :value="JSON.stringify(deletedPrices)"
            />
            <tr v-for="(price, index) in promoPrice" :key="index">
                <td>
                    <input
                        type="hidden"
                        name="promo_id[]"
                        v-model="promoPrice[index].id"
                    />

                    <input
                        type="text"
                        name="amount[]"
                        class="price"
                        v-model="promoPrice[index].amount"
                        required
                    />
                </td>
                <td>
                    <input
                        type="date"
                        name="start_date[]"
                        v-model="promoPrice[index].start_date"
                        required
                    />
                </td>
                <td>
                    <input
                        type="date"
                        name="end_date[]"
                        v-model="promoPrice[index].end_date"
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
</template>

<script setup>
import { onMounted, reactive } from "vue";

const props = defineProps(["existing"]);
const promoPrice = reactive([]);

const deletedPrices = reactive([]);

const addRow = () => {
    promoPrice.push({
        id: null,
        amount: 0,
        start_date: "",
        end_date: "",
    });
};

onMounted(() => {
    if (props.existing) {
        props.existing.map((existing) => {
            promoPrice.push({
                id: existing.id,
                amount: existing.price,
                start_date: existing.start_date,
                end_date: existing.end_date,
            });
        });
    }
});

const deleteRow = (index) => {
    if (confirm("Are you sure you want to delete this?")) {
        if (promoPrice[index].id) {
            deletedPrices.push(promoPrice[index].id);
        }
        promoPrice.splice(index, 1);
    }
};
</script>
