<x-page-content title="Orders">


    @php

        $columns = [
            ['label' => 'Sl No', 'column' => 'id', 'sort' => true],
            ['label' => 'Name', 'column' => 'name', 'sort' => true],
            ['label' => 'Email', 'column' => 'email', 'sort' => true],
            ['label' => 'Order Date', 'column' => 'order_date', 'sort' => true],
            ['label' => 'Sub Total', 'column' => 'sub_total', 'sort' => true],
            ['label' => 'Tax Total', 'column' => 'tax_total', 'sort' => true],
            ['label' => 'Grand Total', 'column' => 'grand_total', 'sort' => true],
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

    <x-table :columns="$columns" :data="$orders" checkAll="{{ true }}" :bulk="route('admin.orders.destroy', ['order' => 'bulk'])" :route="route('admin.orders.index')">
        <x-slot:filters>
            <form action="{{ route('admin.orders.exports') }}" method="POST">
                @csrf
                <div class="row px-2">
                    <div class="col-lg-3">
                        <div class="cdate">
                            <input type="date" class="form-control" name="from_date" id="from_date">
                        </div>
                    </div>
                    <div class="col-lg-1 text-center my-auto">
                        <span class="fw-semibold fs-6">To</span>
                    </div>
                    <div class="col-lg-3">
                        <div class="cdate">
                            <input type="date" class="form-control" name="to_date" id="to_date">
                        </div>
                    </div>
                    <div class="col-3">
                        <button type="submit" class="add-btn bg-success text-white">Export</button>
                    </div>
                </div>
            </form>
        </x-slot:filters>

        @foreach ($orders as $key => $item)
            @php

                $actions = [
                    [
                        'code' => 'view',
                        'route' => route('admin.orders.show', $item->id),
                    ],
                ];
            @endphp
            <tr>
                <td>
                    <input type="checkbox" name="selected_items[]" class="single-item-check"
                        value="{{ $item->id }}">
                </td>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->order_date }}</td>
                <td>{{ $item->sub_total }}</td>
                <td>{{ $item->tax_total }}</td>
                <td>{{ $item->grand_total }}</td>
                <td>
                    <span class="badge rounded-pill {{ $item->status }}">{{ $item->status }}</span>
                </td>
                <td>
                    <x-actions :item="$item" :options="$actions" />
                </td>
            </tr>
        @endforeach
    </x-table>

</x-page-content>
