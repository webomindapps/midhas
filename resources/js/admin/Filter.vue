<template>
    <input
        type="hidden"
        name="deletedFilterItems"
        :value="JSON.stringify(deletedFilterItems)"
    />
    <input
        type="hidden"
        name="deletedFilterSpecification"
        :value="JSON.stringify(deletedFilterSpecification)"
    />

    <div v-for="(filter, index) in items" :key="filter">
        <h6>{{ filter.filterType }}</h6>
        <input type="hidden" name="filter_id[]" :value="filter.filterTypeId" />
        <input type="hidden" name="filter_for[]" :value="filter.filterType" />

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Filter Type</th>
                    <th>Column Name</th>
                    <!-- <th>Is Specification</th>
                    <th>Specification</th> -->
                    <th>
                        <a class="manual-add" @click="addRow(index)">
                            <i class="fal fa-plus"></i>
                        </a>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(subItem, key) in filter.subItems" :key="key">
                    <input
                        type="hidden"
                        :name="`filter_item_id[${index}][]`"
                        v-model="items[index].subItems[key].id"
                    />
                    <td>
                        <input
                            type="text"
                            :name="`name[${index}][]`"
                            v-model="items[index].subItems[key].name"
                            required
                        />
                    </td>
                    <td>
                        <input
                            type="text"
                            :name="`position[${index}][]`"
                            v-model="items[index].subItems[key].position"
                            required
                        />
                    </td>
                    <td>
                        <select
                            :name="`filter_types[${index}][]`"
                            v-model="items[index].subItems[key].filterType"
                            required
                        >
                            <option value="">Select</option>
                            <option value="checkbox">Checkbox</option>
                            <option value="input-range">Input Range</option>
                        </select>
                    </td>
                    <td>
                        <input
                            type="text"
                            :name="`column_names[${index}][]`"
                            v-model="items[index].subItems[key].column_name"
                            required
                        />
                    </td>
                    <!-- <td>
                        <select
                            :name="`is_specification[${index}][]`"
                            v-model="items[index].subItems[key].isSpecification"
                            required
                        >
                            <option value="">Select</option>
                            <option :value="1">Yes</option>
                            <option :value="0">No</option>
                        </select>
                    </td>
                    <td>
                        <input
                            type="hidden"
                            :value="
                                JSON.stringify(
                                    items[index].subItems[key].specifications
                                )
                            "
                            :name="`specifications[${index}][]`"
                        />
                        <div style="position: relative">
                            <input
                                type="text"
                                v-model="items[index].subItems[key].specKeyword"
                                placeholder="search here"
                                @keyup="searchSpecification(index, key)"
                            />
                            <div
                                class="search-results"
                                v-if="items[index].subItems[key].showResult"
                            >
                                <div
                                    class="close-icon"
                                    @click="
                                        items[index].subItems[
                                            key
                                        ].showResult = false
                                    "
                                >
                                    <i
                                        class="fa fa-times"
                                        aria-hidden="true"
                                    ></i>
                                </div>
                                <div
                                    class="search-item"
                                    v-for="result in items[index].subItems[key]
                                        .specSearchResult"
                                    :key="result.id"
                                    @click="
                                        handleSpecification(index, key, result)
                                    "
                                >
                                    <input
                                        type="checkbox"
                                        :value="result.id"
                                        :checked="
                                            items[index].subItems[
                                                key
                                            ].specifications.some(
                                                (obj) => obj.id == result.id
                                            )
                                        "
                                    />
                                    <span>{{ result.name }}</span>
                                </div>
                            </div>
                        </div>
                        <div
                            class="mt-2"
                            v-if="
                                items[index].subItems[key].specifications.length
                            "
                        >
                            <ul>
                                <li
                                    v-for="(
                                        selectedItem, selectItemIndex
                                    ) in items[index].subItems[key]
                                        .specifications"
                                    :key="selectedItem.id"
                                >
                                    <input
                                        type="hidden"
                                        :name="`filter_item_specification_id[${index}][${key}][]`"
                                        :value="selectedItem.storeId"
                                    />

                                    <input
                                        type="hidden"
                                        :name="`specifications_id[${index}][${key}][]`"
                                        :value="selectedItem.id"
                                    />
                                    <input
                                        type="hidden"
                                        :name="`specifications_name[${index}][${key}][]`"
                                        :value="selectedItem.name"
                                    />
                                    <div class="remove-single-spec">
                                        <div>{{ selectedItem.name }}</div>
                                        <div
                                            @click="
                                                deleteSpecification(
                                                    index,
                                                    key,
                                                    selectItemIndex
                                                )
                                            "
                                        >
                                            <i
                                                class="fa fa-times"
                                                aria-hidden="true"
                                            ></i>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </td> -->
                    <td>
                        <a class="manual-add" @click="deleteRow(index, key)">
                            <i class="fal fa-trash"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import { reactive } from "vue";
import { onMounted, ref } from "vue";
import { debounce } from "lodash";

let URL = window._url;

const props = defineProps(["list", "details"]);

const filterFor = ["List", "Details"];

const items = ref([]);
const state = items.value;

const deletedFilterItems = reactive([]);
const deletedFilterSpecification = reactive([]);

onMounted(() => {
    console.log(props);
    if (props.list) {
        filterFor.map((item, index) => {
            state.push({
                filterTypeId: item == "List" ? props.list.id : props.details.id,
                filterType: item,
                subItems: getExistingItems(item, index),
            });
        });
    } else {
        filterFor.map((item) => {
            state.push({
                filterTypeId: null,
                filterType: item,
                subItems: [],
            });
        });
    }
});

const getExistingItems = (item, index) => {
    let existingItems = [];

    if (item == "List") {
        props.list.items.map((filterItem) => {
            existingItems.push({
                id: filterItem.id,
                name: filterItem.name,
                position: filterItem.position,
                filterType: filterItem.type,
                column_name: filterItem.column_name,
                isSpecification: filterItem.is_specification,
                specKeyword: "",
                showResult: false,
                specSearchResult: [],
                specifications: getExistingSpecification(filterItem),
            });
        });
    } else {
        props.details?.items.map((filterItem) => {
            existingItems.push({
                id: filterItem.id,
                name: filterItem.name,
                position: filterItem.position,
                filterType: filterItem.type,
                column_name: filterItem.column_name,
                isSpecification: filterItem.is_specification,
                specKeyword: "",
                showResult: false,
                specSearchResult: [],
                specifications: getExistingSpecification(filterItem),
            });
        });
    }

    return existingItems;
};

const getExistingSpecification = (filterItem) => {
    let specificationItems = [];

    filterItem.filter_specification_items.map((spec) => {
        specificationItems.push({
            storeId: spec.id,
            id: spec.specification_id,
            name: spec.specification_name,
        });
    });

    return specificationItems;
};

const addRow = (index) => {
    state[index].subItems.push({
        id: null,
        name: "",
        position: 1,
        filterType: "checkbox",
        isSpecification: 1,
        specKeyword: "",
        showResult: false,
        specSearchResult: [],
        specifications: [],
    });
};

const deleteRow = (index, key) => {
    if (confirm("Are you sure you want to delete this?")) {
        if (state[index].subItems[key].id) {
            deletedFilterItems.push(state[index].subItems[key].id);
        }
        state[index].subItems.splice(key, 1);
    }
};

const searchSpecification = debounce((index, key) => {
    let keyword = state[index].subItems[key].specKeyword;

    if (keyword.length < 2) {
        state[index].subItems[key].specSearchResult = [];
        return;
    }

    axios
        .get(URL + "/admin/searchSpecification", {
            params: {
                keyword,
            },
        })
        .then((res) => {
            if (res.data.length > 0) {
                state[index].subItems[key].showResult = true;
                state[index].subItems[key].specSearchResult = res.data;
                return;
            }
            state[index].subItems[key].showResult = false;
        })
        .catch((e) => {
            console.log("error", e);
        });
}, 300);

const handleSpecification = (index, key, selectedItem) => {
    let itemIndex = state[index].subItems[key].specifications.findIndex(
        (x) => x.id == selectedItem.id
    );

    if (itemIndex > -1) {
        if (state[index].subItems[key].specifications[itemIndex].storeId) {
            deletedFilterSpecification.push(
                state[index].subItems[key].specifications[itemIndex].storeId
            );
        }

        state[index].subItems[key].specifications.splice(itemIndex, 1);
    } else {
        state[index].subItems[key].specifications.push({
            storeId: null,
            id: selectedItem.id,
            name: selectedItem.name,
        });
    }
};

const deleteSpecification = (index, key, selectItemIndex) => {
    if (confirm("Are you sure you want to delete this?")) {
        if (
            state[index].subItems[key].specifications[selectItemIndex].storeId
        ) {
            deletedFilterSpecification.push(
                state[index].subItems[key].specifications[selectItemIndex]
                    .storeId
            );
        }
        state[index].subItems[key].specifications.splice(selectItemIndex, 1);
    }
};
</script>

<style scoped>
.search-results {
    background: #f2f0f0;
    padding: 10px;
    position: absolute;
    width: 100%;
    z-index: 10;
    margin-top: 5px;
    border: 1px solid #ccc;
}

.search-item {
    display: flex;
    align-items: center;
}

.search-item span {
    margin-left: 5px;
}

.close-icon {
    text-align: right;
    font-size: 20px;
    cursor: pointer;
}

.remove-single-spec {
    display: flex;
    justify-content: space-between;
}
</style>
