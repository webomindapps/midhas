<x-page-content title="Products Sent To Friend List">
     @php

        $columns = [
            ['label' => 'Sl No', 'column' => 'id', 'sort' => true],
            ['label' => 'Name', 'column' => 'name', 'sort' => true],
            ['label' => 'Email', 'column' => 'email', 'sort' => true],
            ['label' => 'Friend Name', 'column' => 'friend_name', 'sort' => true],
            ['label' => 'Friend Email', 'column' => 'friend_email', 'sort' => false],
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

    <x-table :columns="$columns" :data="$tellafriend" checkAll="{{ true }}" :bulk="route('admin.tellafriend.destroy', ['tellafriend' => 'bulk'])" :route="route('admin.tellafriend.index')">
        @foreach ($tellafriend as $key => $item)
            @php

                $actions = [
                   
                    [
                        'code' => 'view',
                        'route' => route('admin.tellafriend.show', $item->id),
                    ],
                ];
            @endphp
            <tr>
                <td>
                    <input type="checkbox" name="selected_items[]" class="single-item-check" value="{{ $item->id }}">
                </td>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>

                <td>{{ $item->friends_name }}</td>
                <td>{{ $item->friends_email }}</td>
                    {{-- <td>{{ \Illuminate\Support\Str::words($item->blog_description, 5, '...') }}</td>


                <td>
                    @if ($item->status)
                        <span class="badge rounded-pill sactive">Active</span>
                    @else
                        <span class="badge rounded-pill deactive">In-Active</span>
                    @endif
                </td> --}}
                <td>
                    <x-actions :item="$item" :options="$actions" />
                </td>
            </tr>
        @endforeach
    </x-table>
</x-page-content>
