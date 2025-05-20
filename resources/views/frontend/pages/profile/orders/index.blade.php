<x-frontend.page>
    <x-frontend.my-profile></x-frontend.my-profile>
    <x-frontend.my-profile>
        <div class="row">
            <div class="col-lg-6">
                <h3 class="mb-3">My Orders</h3>
            </div>

        </div>
        <div class="row mt-4">
            <form action="" method="GET">
                <div class="row">
                    <div class="col-md-4">
                        <div class="search-option">
                            <label for="">Search orders</label>
                            <input type="text" name="search" value="{{ $search }}" class="form-control"
                                placeholder="Search here..." id="">
                        </div>
                    </div>
                    <div class="col-md-2">

                        <div class="item-select">
                            <label for="">Items Per Page</label>
                            <select name="paginate" class="form-select">
                                <option @if ($paginate == '10') selected @endif value="10"> 10 </option>
                                <option @if ($paginate == '20') selected @endif value="20"> 20 </option>
                                <option @if ($paginate == '30') selected @endif value="30"> 30 </option>
                                <option @if ($paginate == '40') selected @endif value="40"> 40 </option>
                                <option @if ($paginate == '50') selected @endif value="50"> 50 </option>
                                <option @if ($paginate == '100') selected @endif value="100"> 100 </option>
                                <option @if ($paginate == '500') selected @endif value="500"> 500 </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 mt-auto">
                        <button class="apply_btn">
                            Apply
                        </button>
                    </div>
                </div>
            </form>



            <div class="row mt-5 order-summary-table">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Order ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Date</th>
                                <th scope="col">Total</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($orders) > 0)
                                @foreach ($orders as $key => $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->name }}</td>
                                        <td>{{ $order->email }}</td>
                                        <td>{{ $order->order_date }}</td>
                                        <td>${{ $order->grand_total }}</td>
                                        <td>
                                            <button class="btn completed">{{ $order->status }}</button>
                                        </td>
                                        <td>
                                            <div class="action">
                                                <a href="{{ route('order.show', ['order' => $order]) }}">
                                                    <i class="fas fa-eye fs-4"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7">No Orders Found</td>
                                </tr>
                            @endif

                        </tbody>
                    </table>
                </div>
                {{ $orders->links() }}
            </div>
        </div>
    </x-frontend.my-profile>
</x-frontend.page>
