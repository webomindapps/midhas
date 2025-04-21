<x-page-content :title="$category->name" :isBack="true">

    <div class="col-lg-12 pb-4 mt-4">
        <div class="parent-cat border">
            <div class="category-list">
                <div class="input-check">
                    <label for="category-15">{{ $category->name }}</label>
                </div>
            </div>

            @if (count($category->children) > 0)
                <x-admin.category-show-item :categories="$category->children" :show="false" />
            @endif
            
        </div>

    </div>
    <x-slot:scripts>
        <script src="{{ asset('admin/js/table.js') }}"></script>
    </x-slot:scripts>

</x-page-content>
