@props(['categories', 'existing' => []])
<div class="mid-child">
    @foreach ($categories as $category)
        <div class="col-lg-6 px-4">
            <div class="input-check">
                <input type="checkbox" class="category" value="{{ $category->id }}" name="categories[]"
                    id="category-{{ $category->id }}" @if (in_array($category->id, $existing)) checked @endif>
                <label for="category-{{ $category->id }}">{{ $category->name }}
                </label>
            </div>
        </div>
        @if (count($category->children) > 0)
            <x-admin.category-item :categories="$category->children" :existing="$existing" />
        @endif
    @endforeach
</div>
