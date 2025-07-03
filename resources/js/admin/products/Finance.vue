<template>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>No Of Months</th>
                <th>Interest</th>
                <th>Financing Fee Interest</th>
                <th>
                    <a class="manual-add" @click="addRow">
                        <i class="fal fa-plus"></i>
                    </a>
                </th>
            </tr>
        </thead>
        <tbody>
            <!-- Hidden field for deleted manual IDs -->
            <input
                type="hidden"
                name="deleted_finance_ids"
                :value="JSON.stringify(deletedManuals)"
            />
            <tr v-for="(manual, index) in manualItems" :key="index">
                <!-- Hidden input to pass manual IDs to the backend -->
                <input
                    type="hidden"
                    name="financing_multiple_item_ids[]"
                    :value="manual.id || ''"
                />
                <td>
                    <input
                        type="text"
                        name="financing_name[]"
                        v-model="manual.name"
                        required
                    />
                </td>
                <td>
                    <input
                        type="text"
                        name="financing_no_of_months[]"
                        v-model="manual.no_of_months"
                        required
                    />
                </td>
                <td>
                    <input
                        type="text"
                        name="financing_interest_per_month[]"
                        v-model="manual.interest"
                        required
                    />
                </td>
                <td>
                    <input
                        type="text"
                        name="financing_fee[]"
                        v-model="manual.fee"
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

const props = defineProps({
    existing: {
        type: Array,
        required: true,
    },
});

const assetUrl = window._asset;
const manualItems = reactive([]);
const deletedManuals = reactive([]);

// Load existing manuals
onMounted(() => {
    (props.existing || []).forEach((item) => {
        manualItems.push({
            id: item.id,
            name: item.name,
            no_of_months: item.no_of_months,
            interest: item.interest_per_month,
            fee: item.price,
        });
    });
});

// Add new row
const addRow = () => {
    manualItems.push({
        id: null,
        name: "",
        no_of_months: "",
        interest: "",
        fee: "",
    });
};

// Delete row
const deleteRow = (index) => {
    if (confirm("Are you sure you want to delete this?")) {
        const id = manualItems[index].id;
        if (id) {
            deletedManuals.push(id);
        }
        manualItems.splice(index, 1);
    }
};
</script>
