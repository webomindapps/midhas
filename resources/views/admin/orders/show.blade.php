<x-page-content :title="'#' . $order->id" :isBack="true">
    <x-slot:breadcrumb>
        @if ($order->status == 'pending')
            <form method="POST" onsubmit="return confirm('Are you sure you want to cancel the order?')"
                action="{{ route('admin.order.cancel', ['order' => $order->id]) }}">
                @csrf
                <button class="submit-btn bg-danger mx-1 mt-0">
                    <i class="fas fa-times me-2"></i>Cancel
                </button>
            </form>
        @endif
        @if (!$order->invoice)
            <a href="{{ route('admin.invoice.create', ['order' => $order->id]) }}"
                class="submit-btn bg-success mx-1 mt-0">
                <i class="fas fa-file-invoice me-2"></i>Invoice
            </a>
        @endif

        @if (!$order->shipment)
            <a href="{{ route('admin.shipment.create', ['order' => $order->id]) }}"
                class="submit-btn bg-warning mx-1 mt-0">
                <i class="fas fa-shipping-timed me-2"></i>Shipment
            </a>
        @endif
    </x-slot:breadcrumb>

    <div class="col-lg-12">
        <div class="mt-5">
            <div class="col-md-12">
                <div class="col-md-12 order-detail">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-Information-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-Information" type="button" role="tab"
                                aria-controls="pills-Information" aria-selected="true">Information
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-Invoices-tab" data-bs-toggle="tab"
                                data-bs-target="#pills-Invoices" type="button" role="tab"
                                aria-controls="pills-Invoices" aria-selected="false">
                                Invoices</button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-Shipments-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-Shipments" type="button" role="tab"
                                aria-controls="pills-Shipments" aria-selected="false">Shipments</button>
                        </li>
                        {{-- <li class="nav-item" role="presentation">
                            <button class="nav-link" data-page="fds" id="pills-Refunds-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-Refunds" type="button" role="tab"
                                aria-controls="pills-Refunds" aria-selected="false">Refunds</button>
                        </li> --}}



                    </ul>


                    <div class="tab-content product-description-tab" id="pills-tabContent">
                        {{-- <div class="tab-pane fade show active" id="pills-Information" role="tabpanel"
                            aria-labelledby="pills-Information-tab">
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                            aria-expanded="false" aria-controls="collapseOne">
                                            Order and Account
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
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
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseTwo" aria-expanded="true"
                                            aria-controls="collapseTwo">
                                            Address
                                        </button>
                                    </h2>
                                    @php
                                        $billing = $order->address('billing');
                                        $shipping = $order->address('shipping');
                                    @endphp
                                    <div id="collapseTwo" class="accordion-collapse collapse show"
                                        aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
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
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                            aria-expanded="false" aria-controls="collapseThree">
                                            Payment and Shipping
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse show"
                                        aria-labelledby="headingThree" data-bs-parent="#accordionExample">
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
                                    <h2 class="accordion-header" id="headingFour">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                            aria-expanded="false" aria-controls="collapseFour">
                                            Products Ordered
                                        </button>
                                    </h2>
                                    <div id="collapseFour" class="accordion-collapse collapse show"
                                        aria-labelledby="headingFour" data-bs-parent="#accordionExample">
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
                                                            <td>${{ $order->tax_total }}</td>
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
                        </div> --}}
                        {{-- <div class="tab-pane fade" id="pills-Invoices" role="tabpanel"
                            aria-labelledby="pills-Invoices-tab">
                            <label for=""> Invoices</label>

                        </div> --}}
                        <div class="tab-pane fade show active" id="pills-Information" role="tabpanel"
                            aria-labelledby="pills-Information-tab">
                            <x-orders.details :order="$order" id="order" />
                        </div>
                        <div class="tab-pane fade" id="pills-Invoices" role="tabpanel"
                            aria-labelledby="pills-Invoices-tab">
                            @if ($order->invoice)
                                <x-orders.details :order="$order" id="invoice">
                                    <x-slot:orderSection>
                                        <div>
                                            <label for="">Comments</label>
                                            <p>{{ ($order->invoice?->comments) }}</p>
                                        </div>
                                    </x-slot:orderSection>
                                </x-orders.details>
                            @else
                                <label for=""> No Invoice found</label>
                            @endif
                        </div>
                        <div class="tab-pane fade" id="pills-Shipments" role="tabpanel"
                            aria-labelledby="pills-Shipments-tab">
                            {{-- <label for="">Shipments</label> --}}
                            @if ($order->shipment)
                                <x-orders.details :order="$order" id="shipment">
                                    <x-slot:addressSection>
                                        @php
                                            $shipment = $order->shipment;
                                        @endphp
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label for="">Shipment Name</label>
                                                <p>{{ $shipment->shipment_name }}</p>
                                            </div>

                                            <div class="col-lg-4">
                                                <label for="">Tracking Id</label>
                                                <p>{{ $shipment->tracking_id }}</p>
                                            </div>
                                            <div class="col-lg-4">
                                                <label for="">Shipment Date</label>
                                                <p>{{ $shipment->shipment_date }}</p>
                                            </div>
                                            <div class="col-lg-12">
                                                <label for="">comments</label>
                                                <p>{{ $shipment->comments }}</p>
                                            </div>
                                        </div>
                                    </x-slot:addressSection>
                                </x-orders.details>
                            @else
                                <label for=""> No Shipment found</label>
                            @endif
                        </div>
                        {{-- <div class="tab-pane fade" id="pills-Refunds" role="tabpanel"
                            aria-labelledby="pills-Refunds-tab">
                            <label for="">Refunds</label>

                        </div> --}}

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-page-content>
