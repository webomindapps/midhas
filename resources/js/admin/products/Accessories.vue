<template>
    <!-- <div class="col-lg-12 mt-2 mb-2" id="form-group-default-size">
        <label for="product_size">Product Accessories</label>
    </div> -->

    <div class="col-lg-12">
        <h6>Add Accessories</h6>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>
                        <a class="manual-add" @click="addRow">
                            <i class="fal fa-plus"></i>
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(pck, index) in packages" :key="index">
                    <td>
                        <input type="text" class="form-control" v-model="pck.name" @blur="autoFillPrice(index)" required/>
                    </td>
                    <td>
                        <input type="text" class="form-control" v-model="pck.price" required />
                    </td>
                    <td>
                        <a class="manual-add text-danger" @click="deleteRow(index)">
                            <i class="fal fa-trash"></i>
                        </a>
                    </td>

                   
                    <input type="hidden" name="accessories_name[]" :value="pck.name" />
                    <input type="hidden" name="accessories_price[]" :value="pck.price" />
                    <input type="hidden" name="accessories_ids[]" :value="pck.id ?? ''" />

                </tr>
            </tbody>
        </table>

        <input type="hidden" name="deleted_product_accessories" v-model="deletedIds" />
    </div>
</template>

<script setup>
import { ref, reactive } from 'vue'

const props = defineProps(['existing', 'size'])

const packages = ref([])
const deletedPackages = reactive([])
const deletedIds = ref('')
const defaultSize = ref('')

// Stores known accessories { name, price }
const knownAccessories = ref([])

// Add row
const addRow = () => {
    packages.value.push({ name: '', price: '' })
}

// Delete row
const deleteRow = (index) => {
    if (confirm("Are you sure you want to delete this?")) {
        if (packages.value[index].id) {
            deletedPackages.push(packages.value[index].id);
            deletedIds.value = JSON.stringify(deletedPackages);
        }
        packages.value.splice(index, 1);
    }
}

// Auto-fill price if accessory name was used before
const autoFillPrice = (index) => {
    const name = packages.value[index].name.trim()
    const match = knownAccessories.value.find(a => a.name === name)
    if (match) {
        packages.value[index].price = match.price
    } else if (packages.value[index].price) {
        // Save to known list
        knownAccessories.value.push({
            name,
            price: packages.value[index].price
        })
    }
}

// Load existing data (edit mode)
// Load existing data (edit mode)
if (props.existing) {
    defaultSize.value = props.size
    props.existing.forEach((item) => {
        packages.value.push({
            id: item.id, // ✅ retain ID
            name: item.name,
            price: item.price
        })
        knownAccessories.value.push({
            name: item.name,
            price: item.price
        })
    })
}

</script>

<style scoped>
.manual-add {
    cursor: pointer;
}
</style>
