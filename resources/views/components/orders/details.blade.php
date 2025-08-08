@props(['order', 'id'])


<div class="accordion" id="accordionExample-{{ $id }}">
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne-{{ $id }}">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseOne-{{ $id }}" aria-expanded="false"
                aria-controls="collapseOne-{{ $id }}">
                Order and Account
            </button>
        </h2>
        <div id="collapseOne-{{ $id }}" class="accordion-collapse collapse show"
            aria-labelledby="headingOne-{{ $id }}" data-bs-parent="#accordionExample-{{ $id }}">
            <div class="accordion-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="secton-title p-2 fw-semibold fs-5  bg-light">
                            <span>Order Information</span>
                        </div>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td> Order Date </td>
                                    <td>{{ $order->order_date }}</td>
                                </tr>
                                <tr>
                                    <td> Order Status</td>
                                    <td> {{ $order->status }}</td>
                                </tr>


                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-6">
                        <div class="secton-title p-2 fw-semibold fs-5 bg-light">
                            <span>Account Information</span>
                        </div>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td> Customer Name </td>
                                    <td>{{ $order->name }}</td>
                                </tr>
                                <tr>
                                    <td> Email</td>
                                    <td> {{ $order->email }} </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

                @if (isset($orderSection))
                    {{ $orderSection }}
                @endif

            </div>
        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingTwo-{{ $id }}">
            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseTwo-{{ $id }}" aria-expanded="true"
                aria-controls="collapseTwo-{{ $id }}">
                Address
            </button>
        </h2>
        @php
            $billing = $order->address('billing');
            $shipping = $order->address('shipping');
        @endphp
                {{-- {{ dd($billing) }} --}}
                

        <div id="collapseTwo-{{ $id }}" class="accordion-collapse collapse show"
            aria-labelledby="headingTwo-{{ $id }}" data-bs-parent="#accordionExample-{{ $id }}">
            <div class="accordion-body">
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

                @if (isset($addressSection))
                    {{ $addressSection }}
                @endif
            </div>
        </div>
    </div>
                {{-- {{ dd($billing) }} --}}

    <div class="accordion-item">
        <h2 class="accordion-header" id="headingThree-{{ $id }}">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseThree-{{ $id }}" aria-expanded="false"
                aria-controls="collapseThree-{{ $id }}">
                Payment and Shipping
            </button>
        </h2>
        <div id="collapseThree-{{ $id }}" class="accordion-collapse collapse show"
            aria-labelledby="headingThree-{{ $id }}" data-bs-parent="#accordionExample-{{ $id }}">
            <div class="accordion-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="secton-title p-2 fw-semibold fs-5  bg-light">
                            <span>Payment Information</span>
                        </div>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td> Payment Method </td>
                                    <td> Bambora</td>
                                </tr>
                                <tr>
                                    <td>Currency</td>
                                    <td> USD</td>
                                </tr>
                                <tr>
                                    <td> Payment Order Id</td>
                                    <td>order1-12174</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-6">
                        <div class="secton-title p-2 fw-semibold fs-5 bg-light">
                            <span>Shipping Information</span>
                        </div>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td> Shipping Method </td>
                                    <td>delivery</td>
                                </tr>
                                <tr>
                                    <td> Shipping Price</td>
                                    <td> $0.00</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="headingFour-{{ $id }}">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseFour-{{ $id }}" aria-expanded="false"
                aria-controls="collapseFour-{{ $id }}">
                Products Ordered
            </button>
        </h2>
        <div id="collapseFour-{{ $id }}" class="accordion-collapse collapse show"
            aria-labelledby="headingFour-{{ $id }}" data-bs-parent="#accordionExample-{{ $id }}">
            <div class="accordion-body">
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
                                <td>{{ $item->price }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>{{ $item->sub_total }}</td>
                                <td>{{ $item->tax_percent }}</td>
                                <td>{{ $item->tax_amount }}</td>
                                <td>{{ $item->grand_total }}</td>
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
                            <tr>
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
                            </tr>
                            <tr class="border-bottom">
                                <td>Tax 13%</td>
                                <td>-</td>
                                <td>$0.00</td>
                            </tr>
                            <tr class="fw-bold pt-2">
                                <td>Grand Total</td>
                                <td>-</td>
                                <td>${{ $order->grand_total }}</td>
                            </tr>
                            <tr class="fw-bold">
                                <td>Total Paid</td>
                                <td>-</td>
                                <td>${{ $order->grand_total }}</td>
                            </tr>
                            <tr class="fw-bold">
                                <td>Total Refunded</td>
                                <td>-</td>
                                <td>$0.00</td>
                            </tr>
                            <tr class="fw-bold">
                                <td>Total Due</td>
                                <td>-</td>
                                <td>$0</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
                {{-- {{ dd($billing) }} --}}

{{ $slot }}
