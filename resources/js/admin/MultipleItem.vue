<template>
    <table class="table">
        <thead>
            <tr>
                <th>Label</th>
                <th>File</th>
                <th>File Link</th>
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
                name="deleted_manual_ids"
                :value="JSON.stringify(deletedManuals)"
            />
            <tr v-for="(manual, index) in manualItems" :key="index">
                <!-- Hidden input to pass manual IDs to the backend -->
                <input type="hidden" name="manual_ids[]" :value="manual.id || ''" />

                <td>
                    <input
                        type="text"
                        name="manual_label[]"
                        v-model="manual.label"
                        required
                    />
                </td>
                <td>
                    <input
                        type="file"
                        name="manual_files[]"
                        :required="!manual.id"
                        @change="handleFileChange($event, index)"
                    />
                    <p class="text-center my-0">
                        <a
                            v-if="manual.id && manual.file"
                            :href="`${assetUrl}storage/${manual.file}`"
                            target="_blank"
                        >
                            View
                        </a>
                    </p>
                </td>
                <td>
                    <input
                        type="url"
                        name="manual_file_link[]"
                        v-model="manual.fileLink"
                        placeholder="Enter file link"
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
      label: item.name,
      file: item.uploaded_file,
      fileLink: item.file_link || '',
    });
  });
});

// Add new row
const addRow = () => {
  manualItems.push({
    id: null,
    label: '',
    file: null,
    fileLink: '',
  });
};

// Handle file change
const handleFileChange = (event, index) => {
  const file = event.target.files[0];
  if (file) {
    manualItems[index].file = file.name;
  }
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
