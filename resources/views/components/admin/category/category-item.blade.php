@props(['categories', 'existing' => null])
<div class="mid-child">
    @foreach ($categories as $category)
        @php
            $childrens = $category->children;
        @endphp

        @if (is_null($existing))
            <div class="col-lg-6 px-4">
                <div class="input-check">
                    <input type="radio" class="category" value="{{ $category->id }}" name="parent_id"
                        id="category-{{ $category->id }}" @if ($existing && $existing->parent_id == $category->id) checked @endif>
                    <label for="category-{{ $category->id }}">{{ $category->name }}
                    </label>
                </div>
            </div>
            @if (count($childrens) > 0)
                <x-admin.category.category-item :categories="$childrens" :existing="$existing" />
            @endif
        @else
            @if ($existing->id != $category->id)
                <div class="col-lg-6 px-4">
                    <div class="input-check">
                        <input type="radio" class="category" value="{{ $category->id }}" name="parent_id"
                            id="category-{{ $category->id }}" @if ($existing && $existing->parent_id == $category->id) checked @endif>
                        <label for="category-{{ $category->id }}">{{ $category->name }}
                        </label>
                    </div>
                </div>
                @if (count($childrens) > 0)
                    <x-admin.category.category-item :categories="$childrens" :existing="$existing" />
                @endif
            @endif
        @endif
    @endforeach
</div>
