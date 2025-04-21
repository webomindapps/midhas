<div class="row px-5 pt-3 pb-4">
    @foreach ($categories as $category)
        @php
            $actions = [
                [
                    'code' => 'active',
                    'route' => null,
                ],
                [
                    'code' => 'inactive',
                    'route' => null,
                ],
                [
                    'code' => 'delete',
                    'route' => null,
                ],
                [
                    'code' => 'edit',
                    'route' => route('admin.categories.edit', $category->id),
                ],
                [
                    'code' => 'view',
                    'route' => route('admin.categories.show', $category->id),
                ],
            ];
        @endphp

        <div class="col-6 mt-3">
            <div class="sub-category px-4">
                <div class="d-flex border-bottom pb-3 justify-content-between">
                    <label for="category-18"><i class="fa fa-minus" aria-hidden="true"></i>
                        {{ $category->name }}
                    </label>
                    <div class="d-flex  justify-content-between">
                        <a href="" class="px-3">
                            @if ($category->status)
                                <i class="fas text-success fa-check-circle"></i>
                            @else
                                <i class="fas text-danger fa-times-circle"></i>
                            @endif
                        </a>
                        <x-actions :item="$category" :options="$actions" />
                    </div>
                </div>

                @if (count($category->children) > 0)
                    <div class="inner-cat bg-light py-1 my-4">
                        @foreach ($category->children as $category)
                            @php
                                $actions = [
                                    [
                                        'code' => 'active',
                                        'route' => null,
                                    ],
                                    [
                                        'code' => 'inactive',
                                        'route' => null,
                                    ],
                                    [
                                        'code' => 'delete',
                                        'route' => null,
                                    ],
                                    [
                                        'code' => 'edit',
                                        'route' => route('admin.categories.edit', $category->id),
                                    ],
                                    [
                                        'code' => 'view',
                                        'route' => route('admin.categories.show', $category->id),
                                    ],
                                ];
                            @endphp
                            <div class="col-lg-12 px-4 my-4">
                                <div class="d-flex justify-content-between">
                                    <label for="category-43"><i class="fa fa-minus" aria-hidden="true"></i>
                                        {{ $category->name }}
                                    </label>
                                    <div class="d-flex justify-content-between">
                                        <a href="" class="px-3">
                                            @if ($category->status)
                                                <i class="fas text-success fa-check-circle"></i>
                                            @else
                                                <i class="fas text-danger fa-times-circle"></i>
                                            @endif
                                        </a>
                                        <x-actions :item="$category" :options="$actions" />
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    @endforeach
</div>
