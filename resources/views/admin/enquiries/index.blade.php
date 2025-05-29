<x-page-content title="Enquiries">

    @php

        $columns = [
            ['label' => 'Sl No', 'column' => 'id', 'sort' => true],
            ['label' => 'Product Name', 'column' => 'product_name', 'sort' => true],
            ['label' => 'SKU', 'column' => 'sku', 'sort' => true],
            ['label' => 'Brand', 'column' => 'brand', 'sort' => true],
            ['label' => 'Name', 'column' => 'name', 'sort' => true],
            ['label' => 'Phone', 'column' => 'phone', 'sort' => true],
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

    <x-table :columns="$columns" :data="$enquiries" checkAll="{{ false }}" :bulk="null" :route="route('admin.enquiries.index')">
        @foreach ($enquiries as $key => $item)
            @php

                $actions = [
                    [
                        'code' => 'view',
                        'route' => route('admin.enquiries.show', $item->id),
                    ],
                ];
            @endphp
            <tr>

                <td>{{ $key + 1 }}</td>
                <td>{{ $item->product_name }}</td>
                <td>{{ $item->sku }}</td>
                <td>{{ $item->brand }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->phone }}</td>
                <td>
                    @if ($item->status == 1)
                        <span>Created</span>
                    @else
                        <span>Completed</span>
                    @endif
                </td>
                <td>
                    <x-actions :item="$item" :options="$actions" />
                </td>
            </tr>
        @endforeach
    </x-table>

</x-page-content>
