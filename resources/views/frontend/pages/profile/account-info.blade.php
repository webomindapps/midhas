<x-frontend.page>

    <x-frontend.my-profile>
        <h4 class="">Account Overview</h4>
        <div class="bg-white border p-4 rounded shadow-sm mt-4">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h6 class="fw-bold text-muted mb-0">Default Address</h6>
                <a href="{{ route('customer.address') }}" class="text-decoration-none small">View Address Book</a>
            </div>
            <hr>

            <address class="text-muted" style="line-height: 1.7;">
                <ul class="list-unstyled">
                    <li>{{ trim(($address->first_name ?? '') . ' ' . ($address->last_name ?? '')) }}</li>
                    <li>{{ $address->address_1 ?? '' }}</li>
                    <li>{{ $address->city ?? '' }} </li>
                    <li> {{ $address->postal_code ?? '' }}</li>
                    <li class="mt-3">{{ $address->province ?? '' }}</li>
                    <li>{{ $address->phone_number ?? '' }}</li>
                </ul>
            </address>
        </div>
        <div class=" p-4 rounded mt-4 text-center">
            <h4 class="mb-3">Recently Viewed Items:</h4>
            <div class="row">
                @foreach ($recentlyViewed as $recents)
                    <div class="col-lg-3">
                        <x-product-card :product="$recents" />
                    </div>
                @endforeach
            </div>
        </div>
    </x-frontend.my-profile>
</x-frontend.page>
