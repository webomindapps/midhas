<table>
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
        ];

    @endphp

    <thead>
        <tr>
            @foreach ($columns as $column)
                <th>
                    {{ $column['label'] }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $key => $item)
            <tr>
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
            </tr>
        @endforeach
    </tbody>
</table>
