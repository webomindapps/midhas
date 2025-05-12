<x-page-content title="Update Filter" isBack="{{ true }}">
    <div class="col-lg-12 pb-4">
        <div class="form-card px-3">
            <form method="POST" class="formSubmit" action="{{ route('admin.settings.filters.update', $filter->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">

                    <x-forms.input label="Select Category" :required="true" size="col-lg-6 mt-4" :value="$filter->category?->name"
                        :readonly="true" />

                    <x-forms.input label="Select Sub Category" :required="true" size="col-lg-6 mt-4" :value="$filter->subCategory?->name"
                        :readonly="true" />


                    <input type="hidden" name="category_id" id="category_id" value="{{ $filter->category_id }}">
                    <input type="hidden" name="sub_category_id" id="sub_category_id"
                        value="{{ $filter->sub_category_id }}">



                    <div class="col-lg-12 mt-4" id="admin-app-one">
                        <filter-section :list="{{ $listFilter }}" :details="{{ $detailFilter }}" />
                    </div>
                </div>


                <button type="submit" class="submit-btn submitBtn">Submit</button>
            </form>
        </div>
    </div>

    <x-slot:scripts>

        <script>
            $(document).ready(function() {
                getSubCategories($('#category_id').val());
            })

            function getSubCategories(category_id) {
                var items = '';
                axios
                    .get("{{ url('/admin/getSubCategories') }}", {
                        params: {
                            id: category_id,
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
            }
            $('#category_id').on('change', function() {

            })
        </script>

    </x-slot:scripts>

</x-page-content>
