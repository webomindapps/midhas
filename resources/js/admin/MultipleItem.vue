<template>
    <div class="col-lg-12">
        <table class="table">
            <thead>
                <tr>
                    <th v-for="(heading, index) in headings" :key="index">
                        {{ heading.title }}
                    </th>
                    <th>
                        <a class="manual-add" @click="addRow">
                            <i class="fal fa-plus"></i>
                        </a>
                    </th>
                </tr>
            </thead>
            <input
                type="hidden"
                :name="`${props.name}_deleted_item_ids`"
                :value="JSON.stringify(deletedItemsIds)"
            />
            <tbody>
                <tr v-for="(state, index) in states" :key="index">
                    <input
                        type="hidden"
                        :name="`${props.name}_multiple_item_ids[]`"
                        v-model="states[index]['id']"
                    />
                    <td v-for="(heading, ind) in headings" :key="ind">
                        <div class="d-flex">
                            <input
                                :type="heading.type"
                                :name="`${heading.name}[]`"
                                v-model="states[index][heading.name]"
                                style="margin-right: 5px"
                            />
                            <template
                                v-if="
                                    heading.type == 'file' &&
                                    checkIfFileExist(index, heading)
                                "
                            >
                                <div>
                                    <a
                                        target="_blank"
                                        :href="
                                            URL +
                                            '/storage/' +
                                            props.existing[index][
                                                heading.db_col
                                            ]
                                        "
                                        >View</a
                                    >
                                </div>
                            </template>
                        </div>
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
import { onMounted, ref } from "vue";

const props = defineProps(["headings", "existing", "name"]);

let URL = window._url;

const states = ref([]);
const deletedItemsIds = ref([]);

onMounted(() => {
    if (props.existing) {
        props.existing.map((ext) => {
            let object = {};
            object["id"] = ext.id;
            props.headings.map((item) => {
                if (item.type == "file") {
                    object[item.name] = "";
                } else {
                    object[item.name] = ext[item.db_col];
                }
            });
            states.value.push(object);
        });
    }
});

const addRow = () => {
    let object = {};
    object["id"] = null;
    props.headings.map((item) => {
        object[item.name] = "";
    });
    states.value.push(object);
};

const deleteRow = (index) => {
    if (confirm("Are you sure you want to delete this?")) {
        if (states.value[index]["id"]) {
            deletedItemsIds.value.push(states.value[index]["id"]);
        }
        states.value.splice(index, 1);
    }
};

const checkIfFileExist = (index, heading) => {
    if (
        props.existing &&
        props.existing[index] &&
        props.existing[index][heading.db_col]
    ) {
        return true;
    }
    return false;
};
</script>
