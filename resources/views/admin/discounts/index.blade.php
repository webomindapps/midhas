<x-page-content title="Discounts Coupons" isCreate="{{ true }}"
    createLink="{{ route('admin.discounts.create') }}">

    @php

        $columns = [
            ['label' => 'Sl No', 'column' => 'id', 'sort' => true],
            ['label' => 'Discount Code', 'column' => 'code', 'sort' => true],
            ['label' => 'Value', 'column' => 'value', 'sort' => true],
            ['label' => 'Type', 'column' => 'type', 'sort' => true],
            ['label' => 'Coupon Type', 'column' => 'coupon_type', 'sort' => true],
            ['label' => 'Expiry Date', 'column' => 'expiry_date', 'sort' => true],
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

    <x-table :columns="$columns" :data="$discounts" checkAll="{{ false }}" :bulk="route('admin.discounts.destroy', ['discount' => 'bulk'])" :route="route('admin.discounts.index')">
        @foreach ($discounts as $key => $item)
            @php

                $actions = [
                    [
                        'code' => 'edit',
                        'route' => route('admin.discounts.edit', $item->id),
                    ],
                    [
                        'code' => 'delete',
                        'route' => null,
                    ],
                ];
            @endphp
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->code }}</td>
                <td>{{ $item->value }}</td>
                <td>
                    @if ($item->type == 1)
                        Dollar
                    @else
                        Percentage
                    @endif
                </td>
                <td>
                    @if ($item->coupon_type == 1)
                        Limited
                    @else
                        Unlimited
                    @endif
                </td>
                <td>{{ $item->expiry_date }}</td>
                <td>
                    <x-actions :item="$item" :options="$actions" />
                </td>
            </tr>
        @endforeach
    </x-table>

</x-page-content>
