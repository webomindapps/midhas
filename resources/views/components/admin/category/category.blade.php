@props(['existing' => null])

<div class="row g-5">

    <div class="col-lg-12">
        <div class="parent-cat border">
            <div class="category-list">
                <div class="input-check">
                    <input type="radio" class="category" name="parent_id" value="{{ null }}" id="category-root"
                        @if ($existing && is_null($existing->parent_id)) checked @endif>
                    <label for="category-root">Root</label>
                </div>
            </div>
        </div>
    </div>
    @foreach ($categories as $category)
        @php
            $childrens = $category->children;
        @endphp
        @if (is_null($existing))
            <div class="col-lg-6">
                <div class="parent-cat border">
                    <div class="category-list">
                        <div class="input-check">
                            <input type="radio" class="category" name="parent_id" value="{{ $category->id }}"
                                id="category-{{ $category->id }}" @if ($existing && $existing->parent_id == $category->id) checked @endif>
                            <label for="category-{{ $category->id }}">{{ $category->name }}</label>
                        </div>
                    </div>

                    @if (count($childrens) > 0)
                        <x-admin.category.category-item :categories="$childrens" :existing="$existing" />
                    @endif
                </div>
            </div>
        @else
            @if ($existing->id != $category->id)
                <div class="col-lg-6">
                    <div class="parent-cat border">
                        <div class="category-list">
                            <div class="input-check">
                                <input type="radio" class="category" name="parent_id" value="{{ $category->id }}"
                                    id="category-{{ $category->id }}" @if ($existing && $existing->parent_id == $category->id) checked @endif>
                                <label for="category-{{ $category->id }}">{{ $category->name }}</label>
                            </div>
                        </div>

                        @if (count($childrens) > 0)
                            <x-admin.category.category-item :categories="$childrens" :existing="$existing" />
                        @endif
                    </div>
                </div>
            @endif
        @endif
    @endforeach
</div>
