<x-page-content title="Customer Details" isBack="{{ true }}">

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 pb-4">
                <div class="form-card px-3">
                    <form action="">
                        <div class="row">
                            <div class="view-detail pt-4 col-lg-6">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th class="width200">First Name</th>
                                            <td>{{ $customer->name }}</td>
                                        </tr>

                                        <tr>
                                            <th class="width200">Email</th>
                                            <td>{{ $customer->email }}</td>
                                        </tr>
                                        <tr>
                                            <th class="width200">Gender</th>
                                            <td>-</td>
                                        </tr>
                                        <tr>
                                            <th class="width200">Date of Birth</th>
                                            <td>-</td>
                                        </tr>
                                        <tr>
                                            <th class="width200">Phone</th>
                                            <td>-</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- <div class="row mt-4">
                            <div class="col-md-12 specification1">
                                <div class="col-md-12 specs">
                                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="pills-Order-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-Order" type="button" role="tab"
                                                aria-controls="pills-Order" aria-selected="true">Order Detail</button>
                                        </li>

                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-Review-tab" data-bs-toggle="tab"
                                                data-bs-target="#pills-Review" type="button" role="tab"
                                                aria-controls="pills-Review" aria-selected="false">Product
                                                Review</button>
                                        </li>

                                    </ul>


                                    <div class="tab-content product-Order-tab" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-Order" role="tabpanel"
                                            aria-labelledby="pills-Order-tab">

                                            <h4 class="mt-4">Order Details</h4>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Sl No</th>
                                                        <th scope="col">Order Date</th>
                                                        <th scope="col">Total Items</th>
                                                        <th scope="col">Sub Total</th>
                                                        <th scope="col">Tax Total</th>
                                                        <th scope="col">Grand Total</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($customer->orders as $key => $order)
                                                        <tr>
                                                            <td scope="col">{{ $key + 1 }}</td>
                                                            <td scope="col">{{ $order->order_date }}</td>
                                                            <td scope="col">{{ $order->total_items }}</td>
                                                            <td>${{ $order->sub_total }}</td>
                                                            <td>${{ $order->tax_total }}</td>
                                                            <td>${{ $order->grand_total }}</td>
                                                            <td scope="col">
                                                                <a
                                                                    href="{{ route('admin.orders.show', ['order' => $order->id]) }}">
                                                                    <i class="fa fa-eye"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach


                                                </tbody>

                                            </table>
                                            <div class="sale-summary p-4 shadow-sm bg-light">
                                                <h4>Total Summary</h4>
                                                <table class="table  table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <td class="width200">Sub Total</td>
                                                            <td class="width80">-</td>
                                                            <td class="width200">
                                                                ${{ $customer->orders()->sum('sub_total') }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Tax</td>
                                                            <td>-</td>
                                                            <td>$ {{ $customer->orders()->sum('tax_total') }} </td>
                                                        </tr>
                                                        <tr>
                                                            <td style="font-size: 18px;">Total</td>
                                                            <td>-</td>
                                                            <td style="font-size: 18px;">
                                                                ${{ $customer->orders()->sum('grand_total') }} </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>


                                        </div>
                                        <div class="tab-pane fade" id="pills-Review" role="tabpanel"
                                            aria-labelledby="pills-Specifications-tab">
                                            <h4 class="mt-4">Product Review</h4>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Sl No</th>
                                                        <th class="width300">Product Name</th>
                                                        <th>Reviews</th>
                                                        <th class="width250">Rating</th>
                                                        <th class="width180">Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($customer->reviews as $key => $review)
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>{{ $review->reviewable_type::find($review->reviewable_id)->name }}
                                                            </td>
                                                            <td>{{ $review->title }}</td>
                                                            <td>{{ $review->rating }}</td>
                                                            <td>{{ $review->created_at->format('d-m-Y') }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-page-content>
