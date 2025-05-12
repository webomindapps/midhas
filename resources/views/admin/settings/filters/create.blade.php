<x-page-content title="Add Filter" isBack="{{ true }}">
    <div class="col-lg-12 pb-4">
        <div class="form-card px-3">
            <form method="POST" class="formSubmit" action="{{ route('admin.settings.filters.store') }}"
                enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <x-forms.select label="Select Category" name="category_id" id="category_id" :required="true"
                        size="col-lg-6 mt-4" :options="Midhas::getCategories('root')" :value="old('category_id')" />

                    <x-forms.select label="Select Sub Category" name="sub_category_id" id="sub_category_id"
                        :required="true" size="col-lg-6 mt-4" :options="[]" :value="old('sub_category_id')" />


                    <div class="col-lg-12 mt-4" id="admin-app-one">
                        <filter-section />
                    </div>
                </div>


                <button type="submit" class="submit-btn submitBtn">Submit</button>
            </form>
        </div>
    </div>

    <x-slot:scripts>

        <script>
            $('#category_id').on('change', function() {
                var items = '';
                axios
                    .get("{{ url('/admin/getSubCategories') }}", {
                        params: {
                            id: $(this).val(),
                        },
                    })
                    .then((res) => {
                        items += '<option value="">Select</option>';
                        res.data.map((item) => {
                            items += `<option value="${item.id}">${item.name}</option>`;
                        })
                        $('#sub_category_id').html("")
                        $('#sub_category_id').append(items)
                    })
                    .catch((e) => {
                        console.log("error", e);
                    });
            })
        </script>

    </x-slot:scripts>

</x-page-content>
