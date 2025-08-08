<x-frontend.page>
    <x-frontend.my-profile>
        <div class="row">
            <div class="col-md-3">
                <h3 class="mb-3">Address Book</h3>
            </div>
        </div>

        <div class="row mt-4">
            @csrf
            @php
                $first = true;
            @endphp

            @foreach ($address->unique('address_1') as $addr)
                @if ($first)
                    <div class="col-md-6 mb-4">
                        <div class="form_wrapper bg-light p-4 rounded shadow-sm">
                            <p>{{ $addr->first_name }} {{ $addr->last_name }}</p>
                            <p>{{ $addr->address_1 }}</p>
                            @if ($addr->address_2)
                                <p>{{ $addr->address_2 }}</p>
                            @endif
                            <p>{{ $addr->city }}</p>
                            <p>{{ $addr->postal_code }}</p>
                            <p>{{ $addr->province }}</p>
                            <p>Tel: {{ $addr->phone_number }}</p>

                            <div class="mt-3 d-flex">
                                <a href="{{ route('customer.edit.address', $addr->id) }}"
                                    class="btn btn-dark me-2">EDIT</a>
                                <form method="GET" action="{{ route('customer.delete.address', $addr->id) }}">
                                    @csrf
                                    <button class="btn btn-outline-dark" type="submit" onclick="return confirm('Are you sure ?')">DELETE</button>
                                </form>
                            </div>

                            <div class="mt-3 d-flex align-items-center">
                                <span class="me-2 text-success">✔</span>
                                <strong>This is your default billing address</strong>
                            </div>
                        </div>
                    </div>
                    @php $first = false; @endphp
                @endif
            @endforeach

        </div>
    </x-frontend.my-profile>
</x-frontend.page>
