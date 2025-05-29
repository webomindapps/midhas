<x-page-content title="Reviews">

    @php

        $columns = [
            ['label' => 'Sl No', 'column' => 'id', 'sort' => true],
            ['label' => 'Product Name', 'column' => 'title', 'sort' => true],
            ['label' => 'Title', 'column' => 'title', 'sort' => true],
            ['label' => 'Rating', 'column' => 'rating', 'sort' => true],
            ['label' => 'Status', 'column' => 'status', 'sort' => true],
            ['label' => 'Actions', 'column' => 'action', 'sort' => false],
        ];

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

    <x-table :columns="$columns" :data="$reviews" checkAll="{{ true }}" :bulk="route('admin.reviews.destroy', ['review' => 'bulk'])" :route="route('admin.reviews.index')">
        @foreach ($reviews as $key => $item)
            @php

                $actions = [
                    [
                        'code' => 'view',
                        'route' => route('admin.reviews.show', $item->id),
                    ],
                ];
            @endphp
            <tr>
                <td>
                    <input type="checkbox" name="selected_items[]" class="single-item-check" value="{{ $item->id }}">
                </td>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->reviewable_type::find($item->reviewable_id)->title }}</td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->rating }}</td>
                <td>
                    @if ($item->status)
                        <span class="badge rounded-pill sactive">Approved</span>
                    @else
                        <span class="badge rounded-pill deactive">Pending</span>
                    @endif
                </td>
                <td>
                    <x-actions :item="$item" :options="$actions" />
                </td>
            </tr>
        @endforeach
    </x-table>

</x-page-content>
