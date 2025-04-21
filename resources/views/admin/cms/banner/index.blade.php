<x-page-content title="Banners" isCreate="{{ true }}" createLink="{{ route('admin.cms.banners.create') }}">
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
            ['label' => 'Catagory', 'column' => 'name', 'sort' => true],
            ['label' => 'Position', 'column' => 'position', 'sort' => true],
            ['label' => 'Type', 'column' => 'type', 'sort' => true],
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

    <x-table :columns="$columns" :data="$banners" checkAll="{{ true }}" :bulk="route('admin.cms.banners.destroy', ['banner' => 'bulk'])" :route="route('admin.cms.banners.index')">
        @foreach ($banners as $key => $item)
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
                        'route' => route('admin.cms.banners.edit', $item->id),
                    ]
                ];
            @endphp
            <tr>
                <td>
                    <input type="checkbox" name="selected_items[]" class="single-item-check" value="{{ $item->id }}">
                </td>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->category->name ?? '-'}}</td>
                <td>{{ $item->position }}</td>
                <td>{{ $item->type }}</td>
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
