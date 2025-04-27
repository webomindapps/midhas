<x-page-content title="Stores" isCreate="{{ true }}" createLink="{{ route('admin.stores.create') }}">

    @php

        $columns = [
            ['label' => 'Sl No', 'column' => 'id', 'sort' => true], 
            ['label' => 'Name', 'column' => 'name', 'sort' => true], 
            ['label' => 'Email', 'column' => 'email', 'sort' => true], 
            ['label' => 'Manager', 'column' => 'manager_name', 'sort' => true], 
            ['label' => 'Location', 'column' => 'location', 'sort' => true], 
            ['label' => 'Status', 'column' => 'status', 'sort' => true], 
            ['label' => 'Actions', 'column' => 'action', 'sort' => false]
        ];

    @endphp

    <x-table :columns="$columns" :data="$stores" checkAll="{{ true }}" :bulk="route('admin.stores.destroy', ['store' => 'bulk'])" :route="route('admin.stores.index')">
        @foreach ($stores as $key => $item)
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
                        'route' => route('admin.stores.edit', $item->id),
                    ],
                    // [
                    //     'code' => 'view',
                    //     'route' => route('admin.stores.show', $item->id),
                    // ],
                ];
            @endphp

            <tr>
                <td>
                    <input type="checkbox" name="selected_items[]" class="single-item-check" value="{{ $item->id }}">
                </td>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->manager_name }}</td>
                <td>{{ $item->location }}</td>
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
