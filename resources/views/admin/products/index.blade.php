<x-page-content title="Products" isCreate="{{ true }}"
    createLink="{{ route('admin.products.create', ['type' => $type]) }}">

    <x-slot:breadcrumb>
        {{-- <x-admin.export-btn>
            <li><a class="dropdown-item"
                    href="{{ route('admin.exports.products', ['all' => true, 'type' => 'simple']) }}">All</a></li>
            <li><a class="dropdown-item"
                    href="{{ route('admin.exports.products', array_merge(request()->query())) }}">Current</a></li>
        </x-admin.export-btn> --}}
    </x-slot:breadcrumb>

    @php

    $columns = [
        ['label' => 'Name', 'column' => 'title', 'sort' => true],
        ['label' => 'SKU', 'column' => 'sku', 'sort' => true],
        ['label' => 'Brand', 'column' => 'brand', 'sort' => false],
        ['label' => 'Stock', 'column' => 'total_stock', 'sort' => false],
        ['label' => 'Selling Price', 'column' => 'selling_price', 'sort' => true],
        ['label' => 'Instore Price', 'column' => 'instore_price', 'sort' => true],
        ['label' => 'MSRP', 'column' => 'msrp', 'sort' => true],
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

<x-table :columns="$columns" :data="$products" checkAll="{{ true }}" :bulk="route('admin.products.destroy', ['product' => 'bulk'])" :route="route('admin.products.index')">
    @foreach ($products as $key => $item)
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
                    'route' => route('admin.products.edit', $item->id),
                ],
                [
                    'code' => 'inventory',
                    'route' => route('admin.products.edit', $item->id).'#heading-stock',
                ],
            ];
        @endphp
        <tr>
            <td>
                <input type="checkbox" name="selected_items[]" class="single-item-check" value="{{ $item->id }}">
            </td>
            <td>{{ $item->title }}</td>
            <td>{{ $item->sku }}</td>
            <td>{{ $item->brand?->name }}</td>
            <td>{{ $item->total_stock }}</td>
            <td>{{ $item->selling_price }}</td>
            <td>{{ $item->instore_price }}</td>
            <td>{{ $item->msrp }}</td>
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
