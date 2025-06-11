<x-page-content title="Delivery City" isCreate="{{ true }}"
    createLink="{{ route('admin.settings.delivery-city.create') }}">
    @php

        $columns = [
            ['label' => 'Id', 'column' => 'id', 'sort' => true],
            ['label' => 'City', 'column' => 'city', 'sort' => true],
            ['label' => 'Delivery Price', 'column' => 'delivery_price', 'sort' => true],
            [
                'label' => 'Minimum Delivery Price',
                'column' => 'min_amt_for_shipping',
                'sort' => true,
            ],
            ['label' => 'Status', 'column' => 'status', 'sort' => false],
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

    <x-table :columns="$columns" :data="$deliverycities" checkAll="{{ true }}" :bulk="route('admin.settings.delivery-city.destroy', ['delivery_city' => 'bulk'])" :route="route('admin.settings.delivery-city.index')">
        @foreach ($deliverycities as $key => $item)
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
                        'route' =>  route('admin.settings.delivery-city.destroy', $item->id),
                    ],
                    [
                        'code' => 'edit',
                        'route' => route('admin.settings.delivery-city.edit', $item->id),
                    ],
                ];
            @endphp
            <tr>
                <td>
                    <input type="checkbox" name="selected_items[]" class="single-item-check" value="{{ $item->id }}">
                </td>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->city }}</td>
                <td>${{ number_format($item->delivery_price, 2) }}</td>

                <td>${{ number_format($item->min_amt_for_shipping, 2) }}</td>
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
