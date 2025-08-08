<x-page-content title="Blogs List" isCreate="{{ true }}" createLink="{{ route('admin.cms.blogs.create') }}">

    @php

        $columns = [
            ['label' => 'Sl No', 'column' => 'id', 'sort' => true],
            ['label' => 'Image', 'column' => 'image', 'sort' => false],
            ['label' => 'Blog Title', 'column' => 'blog_title', 'sort' => true],
            ['label' => 'Blog Date', 'column' => 'blog_date', 'sort' => true],
            ['label' => 'Description', 'column' => 'blog_description', 'sort' => false],
            ['label' => 'Status', 'column' => 'status', 'sort' => false],
            ['label' => 'Actions', 'column' => 'actions', 'sort' => false],
        ];

    @endphp
    @php
        $bulkOptions = [
            [
                'label' => 'Delete',
                'value' => '1',
            ],
            [
                'label' => 'Status',
                'value' => '2',
                'options' => [
                    [
                        'label' => 'Active',
                        'value' => '1',
                    ],
                    [
                        'label' => 'Inactive',
                        'value' => '0',
                    ],
                ],
            ],
        ];
    @endphp

    <x-table :columns="$columns" :data="$blogs" checkAll="{{ true }}" :bulk="route('admin.cms.blogs.destroy', ['blog' => 'bulk'])" :route="route('admin.cms.blogs.index')">
        @foreach ($blogs as $key => $item)
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
                        'route' =>  route('admin.cms.blogs.destroy', $item->id),
                    ],
                    [
                        'code' => 'edit',
                        'route' => route('admin.cms.blogs.edit', $item->id),
                    ],
                ];
            @endphp
            <tr>
                <td>
                    <input type="checkbox" name="selected_items[]" class="single-item-check" value="{{ $item->id }}">
                </td>
                <td>{{ $key + 1 }}</td>
                <td><img src="{{ asset('storage/' . $item->blog_image) }}" width="70" height="70"></td>
                <td>{{ $item->blog_title }}</td>

                <td>{{ $item->blog_date }}</td>
                <td>{{ \Illuminate\Support\Str::words($item->blog_description, 5, '...') }}</td>


                <td>
                    @if ($item->status)
                        <span class="badge rounded-pill sactive">Active</span>
                    @else
                        <span class="badge rounded-pill deactive">In-Active</span>
                    @endif
                </td>
                <td>
                    <x-actions :item="$item" :options="$actions" />
                </td>
            </tr>
        @endforeach
    </x-table>

</x-page-content>
