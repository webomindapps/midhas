<x-frontend.page>

    <x-slot:css>
        <style>
            .bg-light-gray {
                background-color: #e1e1e1;
            }

            .product_order_table table tr td {
                font-size: 14px;
                padding: 10px;
            }

            .sale-summary {
                float: right;
                margin-top: 40px;
                background-color: #fff;
                border-radius: 10px;
                padding: 10px;
            }
        </style>
    </x-slot:css>
    <x-frontend.my-profile>
        <div class="row order-detail-sec">
            <h4 class="bg-light-gray py-3">Order and Account</h4>

            <h5 class="border-bottom pb-2 my-4">Order Information</h5>
            <div class="row">
                <div class="col-3">
                    <p class="fw-semibold">Order Id</p>
                </div>
                <div class="col-9">
                    <p>#{{ $order->id }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <p class="fw-semibold">Order Date</p>
                </div>
                <div class="col-9">
                    <p>{{ $order->order_date }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <p class="fw-semibold">Order Status</p>
                </div>
                <div class="col-9">
                    <p>{{ $order->status }}</p>
                    {{-- {{ dd($order->address('billing')) }} --}}
                </div>
            </div>

            <h5 class="border-bottom pb-2 my-4">Account Information</h5>
            <div class="row">
                <div class="col-3">
                    <p class="fw-semibold">Customer Name</p>
                </div>
                <div class="col-9">
                    <p>{{ $order->name }}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <p class="fw-semibold">Email</p>
                </div>
                <div class="col-9">
                    <p>{{ $order->email }}</p>
                </div>
            </div>

            @php
                $billing = $order->address('billing');
                $shipping = $order->address('shipping');
            @endphp

            <h4 class="bg-light-gray py-3 mt-4">Address</h4>
            <div class="row">
                <div class="col-lg-6">
                    <div class="secton-title p-2 fw-semibold fs-5  bg-light">
                        <span>Billing Address</span>
                    </div>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>
                                    Name </td>
                                <td>{{ $billing->first_name . ' ' . $billing->last_name }}
                                </td>
                            </tr>
                            <tr>
                                <td> Email</td>
                                <td> {{ $billing->email }} </td>
                            </tr>
                            <tr>
                                <td> Contact</td>
                                <td>{{ $billing->contact_number }}</td>
                            </tr>
                            <tr>
                                <td>
                                    City</td>
                                <td>{{ $billing->city }}</td>
                            </tr>
                            <tr>
                                <td>
                                    Province</td>
                                <td>{{ $billing->province }}</td>
                            </tr>
                            <tr>
                                <td>
                                    Postal Code</td>
                                <td>{{ $billing->postal_code }}</td>
                            </tr>
                            <tr>
                                <td>
                                    Address 1</td>
                                <td>{{ $billing->address_1 }}</td>
                            </tr>
                            <tr>
                                <td>
                                    Address 2</td>
                                <td>{{ $billing->address_2 }}
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <div class="col-lg-6">
                    <div class="secton-title p-2 fw-semibold fs-5 bg-light">
                        <span>Shipping Address</span>
                    </div>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>
                                    Name </td>
                                <td>{{ $shipping->first_name . ' ' . $shipping->last_name }}
                                </td>
                            </tr>
                            <tr>
                                <td> Email</td>
                                <td> {{ $shipping->email }} </td>
                            </tr>
                            <tr>
                                <td> Contact</td>
                                <td>{{ $shipping->phone_number }}</td>
                            </tr>
                            <tr>
                                <td>
                                    City</td>
                                <td>{{ $shipping->city }}</td>
                            </tr>
                            <tr>
                                <td>
                                    Province</td>
                                <td>{{ $shipping->province }}</td>
                            </tr>
                            <tr>
                                <td>
                                    Postal Code</td>
                                <td>{{ $shipping->postal_code }}</td>
                            </tr>
                            <tr>
                                <td>
                                    Address 1</td>
                                <td>{{ $shipping->address_1 }}</td>
                            </tr>
                            <tr>
                                <td>
                                    Address 2</td>
                                <td>{{ $shipping->address_2 }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>


            <h4 class="bg-light-gray py-3 mt-4">Payment and Shipping</h4>
            <div class="row">
                <div class="col-lg-12">
                    <h5 class="border-bottom pb-2 my-4">Payment Information</h5>
                    <div class="row">
                        <div class="col-3">
                            <p class="fw-semibold">Payment Method</p>
                        </div>
                        <div class="col-9">
                            <p>Bambora</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <p class="fw-semibold">Currency</p>
                        </div>
                        <div class="col-9">
                            <p>USD</p>
                        </div>
                    </div>

                    <h5 class="border-bottom pb-2 my-4">Shipping Information</h5>
                    <div class="row">
                        <div class="col-3">
                            <p class="fw-semibold">Shipping Method</p>
                        </div>
                        <div class="col-9">
                            <p>pickup</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-3">
                            <p class="fw-semibold">Shipping Price</p>
                        </div>
                        <div class="col-9">
                            <p>$0.00</p>
                        </div>
                    </div>

                </div>
            </div>

            <h4 class="bg-light-gray py-3 mt-4">Products Ordered</h4>
            <div class="product_order_table">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">SKU</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Subtotal</th>
                            <th scope="col">Tax Percent</th>
                            <th scope="col">Tax Amount</th>
                            <th scope="col">Grand Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $item)
                            <tr>
                                <td>{{ $item->sku }}</td>
                                <td>{{ $item->name }}</td>
                                <td>${{ number_format($item->price, 2) }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>${{ number_format($item->sub_total, 2) }}</td>
                                <td>${{ number_format($item->tax_percent, 2) }}</td>
                                <td>${{ number_format($item->tax_amount, 2) }}</td>
                                <td>${{ number_format($item->grand_total, 2) }}</td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
                <div class="sale-summary">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td>Subtotal</td>
                                <td>-</td>
                                <td class="width150">${{ $order->sub_total }}</td>
                            </tr>
                            {{-- <tr>
                                <td>Taxable Product SubTotal </td>
                                <td>-</td>
                                <td> ${{ $order->tax_total }} </td>
                            </tr>
                            <tr>
                                <td>Discount </td>
                                <td>-</td>
                                <td> $0</td>
                            </tr>
                            <tr>
                                <td>Shipping Handling</td>
                                <td>-</td>
                                <td>$0.00</td>
                            </tr> --}}
                            <tr class="border-bottom">
                                <td>Tax 13%</td>
                                <td>-</td>
                                <td>${{ number_format($order->tax_total,2) }}</td>
                            </tr>
                            <tr class="fw-bold pt-2">
                                <td>Grand Total</td>
                                <td>-</td>
                                <td>${{ number_format($order->grand_total,2) }}</td>
                            </tr>
                            <tr class="fw-bold">
                                <td>Total Paid</td>
                                <td>-</td>
                                <td>${{ number_format($order->grand_total,2) }}</td>
                            </tr>
                            <tr class="fw-bold">
                                <td>Total Refunded</td>
                                <td>-</td>
                                <td>$0.00</td>
                            </tr>
                            <tr class="fw-bold">
                                <td>Total Due</td>
                                <td>-</td>
                                <td>$0.00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </x-frontend.my-profile>
</x-frontend.page>
