<x-page-content title="Customer  Questions List">

    @php

        $columns = [
            ['label' => 'Sl No', 'column' => 'id', 'sort' => true],
            ['label' => 'Name', 'column' => 'image', 'sort' => false],
            ['label' => 'Email', 'column' => 'blog_title', 'sort' => true],
            ['label' => 'Phone', 'column' => 'blog_date', 'sort' => true],
            ['label' => 'Question', 'column' => 'blog_description', 'sort' => false],
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

    <x-table :columns="$columns" :data="$questions" checkAll="{{ true }}" :bulk="route('admin.askquestions.destroy', ['askquestion' => 'bulk'])" :route="route('admin.askquestions.index')">
        @foreach ($questions as $key => $item)
            @php

                $actions = [
                   
                    [
                        'code' => 'view',
                        'route' => route('admin.askquestions.show', $item->id),
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

                <td>{{ $item->phone }}</td>
                <td>{{ $item->question }}</td>
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
