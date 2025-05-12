<x-page-content title="Filters" isCreate="{{ true }}" createLink="{{ route('admin.settings.filters.create') }}">

    @php

        $columns = [
            ['label' => 'Sl No', 'column' => 'id', 'sort' => true],
            ['label' => 'Category', 'column' => 'category_id', 'sort' => false],
            ['label' => 'Sub Category', 'column' => 'sub_category_id', 'sort' => false],
            ['label' => 'Filter For', 'column' => 'filter_for', 'sort' => false],
            ['label' => 'Actions', 'column' => 'action', 'sort' => false],
        ];

    @endphp

    <x-table :columns="$columns" :data="$filters" :bulk="route('admin.settings.filters.destroy', ['filter' => 'bulk'])" :route="route('admin.settings.filters.index')">
        @foreach ($filters as $key => $item)
            @php

                $actions = [
                    // [
                    //     'code' => 'active',
                    //     'route' => null,
                    // ],
                    // [
                    //     'code' => 'inactive',
                    //     'route' => null,
                    // ],
                    [
                        'code' => 'delete',
                        'route' => null,
                    ],
                    [
                        'code' => 'edit',
                        'route' => route('admin.settings.filters.edit', $item->id),
                    ],
                ];
            @endphp

            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->category?->name }}</td>
                <td>{{ $item->subCategory?->name }}</td>
                <td>{{ $item->filter_for }}</td>
                <td>
                    <x-actions :item="$item" :options="$actions" />
                </td>
            </tr>
        @endforeach
    </x-table>

</x-page-content>
