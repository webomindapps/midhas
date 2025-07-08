<x-page-content title="Newsletters" isCreate="{{ false }}">
    @php

        $columns = [
            ['label' => 'Sl No', 'column' => 'id', 'sort' => true],
            ['label' => 'Email', 'column' => 'email', 'sort' => true],
        ];

    @endphp

    <x-table :columns="$columns" :data="$newsletter" checkAll="{{ false }}" :bulk="route('admin.newsletters.index')" :route="route('admin.newsletters.index')">
        @foreach ($newsletter as $key => $item)
            <tr>

                <td>{{ $item->id }}</td>
                <td>{{ $item->email }}</td>

            </tr>
        @endforeach
    </x-table>
</x-page-content>
