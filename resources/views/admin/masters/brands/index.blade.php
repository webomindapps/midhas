<x-page-content title="Brands" isCreate="{{ true }}" createLink="{{ route('admin.masters.brands.create') }}">
    <x-slot:breadcrumb>
        {{-- <x-admin.export-btn>
            <li>
                <a class="dropdown-item" href="{{ route('admin.exports.category', ['all' => true]) }}">All</a>
            </li>
            <li>
                <a class="dropdown-item" href="{{ route('admin.exports.category', array_merge(request()->query())) }}">Current</a>
            </li>
        </x-admin.export-btn> --}}
    </x-slot:breadcrumb>

    @php

        $columns = [
            ['label' => 'Sl No', 'column' => 'id', 'sort' => true],
            ['label' => 'logo', 'column' => 'logo', 'sort' => false],
            ['label' => 'Name', 'column' => 'name', 'sort' => true],
            ['label' => 'Position', 'column' => 'position', 'sort' => true],
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

    <x-table :columns="$columns" :data="$brands" checkAll="{{ true }}" :bulk="route('admin.masters.brands.destroy', ['brand' => 'bulk'])" :route="route('admin.masters.brands.index')">
        @foreach ($brands as $key => $item)
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
                        'route' => route('admin.masters.brands.edit', $item->id),
                    ]
                ];
            @endphp
            <tr>
                <td>
                    <input type="checkbox" name="selected_items[]" class="single-item-check" value="{{ $item->id }}">
                </td>
                <td>{{ $key + 1 }}</td>
                <td>
                    <img src="{{ $item->image?->url }}" height="80" width="80" alt="{{ $item->name }}"
                        class="img-fluid rounded-circle" />
                </td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->position }}</td>
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
