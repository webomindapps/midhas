@props(['existing' => []])

<div class="row g-5">

    @foreach ($categories as $category)
        <div class="col-lg-6 mb-1">
            <div class="parent-cat border">
                <div class="category-list">
                    <div class="input-check">
                        <input type="checkbox" class="category" name="categories[]" value="{{ $category->id }}"
                            id="category-{{ $category->id }}" @if (in_array($category->id, $existing)) checked @endif>
                        <label for="category-{{ $category->id }}">{{ $category->name }}</label>
                    </div>
                </div>

                @if (count($category->children) > 0)
                    <x-admin.category-item :categories="$category->children" :existing="$existing" />
                @endif
            </div>
        </div>
    @endforeach
</div>
