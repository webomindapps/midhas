@extends('mail.master')

@section('title')
    Order has been shipped
@endsection

@section('contents')
    @php
        $billing = $order->address('billing');
        $shipping = $order->address('shipping');
    @endphp
    <table style="margin-top: 10px;">
        <tbody>
            <tr>
                <td style="font-size: 14px;">
                    <table>
                        <tbody>
                            <tr>
                                <th style="font-size: 18px; padding-bottom: 14px;">
                                    Bill To:
                                </th>
                            </tr>
                            <tr>
                                <td style="padding-top: 0px;">Name : </td>
                                <td style="padding-top: 0px;">
                                    {{ $billing->first_name . ' ' . $billing->last_name }}
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top: 0px;">Email : </td>
                                <td style="padding-top: 0px;">
                                    <a href="mailto:info@usermail.com">{{ $billing->email }}</a>
                                </td>
                            </tr>

                            <tr>
                                <td style="padding-top: 0px;">Phone No. : </td>
                                <td style="padding-top: 0px;">
                                    <a href="tel:{{ $billing->phone_number }}">{{ $billing->phone_number }}</a>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top: 0px;">Address : </td>
                                <td style="padding-top: 0px;">
                                    {{ $billing->address_1 }}, <br> {{ $billing->address_2 }}, <br> ON
                                    {{ $billing->postal_code }}
                                </td>
                            </tr>


                        </tbody>
                    </table>
                </td>
                <td style="font-size: 14px;">
                    <table>
                        <tbody>
                            <tr>
                                <th style="font-size: 18px; padding-bottom: 14px;">
                                    Ship To:
                                </th>
                            </tr>
                            <tr>
                                <td style="padding-top: 0px;">Name : </td>
                                <td style="padding-top: 0px;">
                                    {{ $shipping->first_name . ' ' . $shipping->last_name }}
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top: 0px;">Email : </td>
                                <td style="padding-top: 0px;">
                                    <a href="mailto:info@usermail.com">{{ $shipping->email }}</a>
                                </td>
                            </tr>

                            <tr>
                                <td style="padding-top: 0px;">Phone No. : </td>
                                <td style="padding-top: 0px;">
                                    <a href="tel:{{ $shipping->phone_number }}">{{ $shipping->phone_number }}</a>
                                </td>
                            </tr>
                            <tr>
                                <td style="padding-top: 0px;">Address : </td>
                                <td style="padding-top: 0px;">
                                    {{ $shipping->address_1 }}, <br> {{ $shipping->address_2 }}, <br> ON
                                    {{ $shipping->postal_code }}
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    <table style="margin-top: 10px;">
        <tbody>
            <tr>
                <td style="padding-top: 0px;">Shipment Name : </td>
                <td style="padding-top: 0px;">
                    {{ $order->shipment_name }}
                </td>
            </tr>
            <tr>
                <td style="padding-top: 0px;">Tracking Id : </td>
                <td style="padding-top: 0px;">
                    {{ $order->tracking_id }}
                </td>
            </tr>
            <tr>
                <td style="padding-top: 0px;">Shipment Date : </td>
                <td style="padding-top: 0px;">
                    {{ $order->shipment_date }}
                </td>
            </tr>
            <tr>
                <td style="padding-top: 0px;">comments : </td>
                <td style="padding-top: 0px;">
                    {{ $order->comments }}
                </td>
            </tr>
        </tbody>
    </table>

    <table class="table table-bordered" style="margin-top: 20px;">
        <tbody>
            <thead style="background-color: #e6e6e6;">
                <tr>
                    <th>Order No </th>
                    <th>Order Date </th>
                    <th>Sales Person</th>
                    <th>Customer PO No</th>
                    <th>Confirmation No</th>
                    <th>Delivery Mode</th>
                    <th>Delivery Date </th>
                </tr>
            </thead>
            <tr>
                <td style="padding: 7px 10px;">
                    #{{ $order->id }}
                </td>
                <td style="padding: 7px 10px; ">
                    {{ $order->created_at->format('M, d, Y') }}
                </td>

                <td style="padding: 7px 10px; ">
                    Montie
                </td>
                <td style="padding: 7px 10px; ">
                    -
                </td>
                <td style="padding: 7px 10px; ">
                    -
                </td>
                <td style="padding: 7px 10px; ">
                    {{ $order->order_type }}
                </td>
                <td style="padding: 7px 10px; ">
                    {{ $order->order_date }}
                </td>
            </tr>

        </tbody>
    </table>


    <table class="table table-bordered  h4-14" style="width: 100%; -fs-table-paginate: paginate; margin-top: 30px;">
        <thead style="display: table-header-group; background-color: #e6e6e6;">
            <tr style=" margin: 0; -webkit-print-color-adjust: exact;">
                <th style="font-size: 13px;">
                    Qty
                </th>
                <th style="font-size: 13px">
                    Product
                </th>
                <th style="font-size: 13px">
                    Brand
                </th>
                <th style="font-size: 13px">
                    Model
                </th>
                <th style="font-size: 13px">
                    Serial No
                </th>
                <th style="font-size: 13px">
                    Price
                </th>
                <th style="font-size: 13px">
                    Total
                </th>
                <th style="font-size: 13px">
                    Tax
                </th>

                <th style="text-align: center; font-size: 13px;">
                    Grand Total
                </th>
            </tr>

        </thead>
        <tbody>
            @foreach ($order->items as $item)
                <tr>
                    <td style="font-size: 13px;">{{ $item->qty }}</td>
                    <td style="font-size: 13px">{{ $item->name }}</td>
                    <td style="font-size: 13px">{{ $item->brand?->name }}</td>
                    <td style="font-size: 13px"> {{ $item->sku }} </td>
                    <td style="font-size: 13px">{{ $item->upc_code }}</td>
                    <td style="font-size: 13px">${{ $item->price }}</td>
                    <td style="font-size: 13px">${{ $item->sub_total }}</td>
                    <td style="font-size: 13px">${{ $item->tax_amount }}</td>
                    <td style="text-align: center; font-size: 13px;">${{ $item->grand_total }}</td>
                </tr>
            @endforeach
        </tbody>

    </table>

    <table>
        <tbody>
            <tr>
                <td style="width: 40%; padding-top: 34%;">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>
                                    Amount
                                </th>
                                <th>
                                    Paid By
                                </th>
                            </tr>
                            <tr>
                                <td>${{ $order->grand_total }}</td>
                                <td>Master Card</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td></td>
                <td style="width: 40%; margin-left: auto; font-size: 14px; padding-top: 15px;">
                    <table>
                        <tbody>
                            <tr>
                                <td style="padding-top: 0;">Credits Issued :</td>
                                <td style="text-align: end; font-weight: 600; padding-top:5px">$0.00</td>
                            </tr>
                            <tr>
                                <td style="padding-top: 0;">Restocking Charges :</td>
                                <td style="text-align: end; font-weight: 600; padding-top:5px">$0.00</td>
                            </tr>
                            <tr>
                                <td style="padding-top: 0;">Environmental Fee:</td>
                                <td style="text-align: end; font-weight: 600; padding-top:5px">$0.00</td>
                            </tr>
                            <tr>
                                <td style="padding-top: 0;">Sales Sub Total:</td>
                                <td style="text-align: end; font-weight: 600; padding-top:5px">${{ $order->sub_total }}
                                </td>
                            </tr>
                            <tr style=" background-color: #e6e6e6;">
                                <td style=" font-size: 16px; font-weight: 600; padding-top:8px">Sub Total:</td>
                                <td style="text-align: end;padding-top: 10px;font-size: 16px; font-weight: 600">
                                    ${{ $order->sub_total }}
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                            </tr>
                            {{-- <tr>
                                <td style="padding-top: 0;">GST # :</td>
                                <td style="text-align: end; font-weight: 600; padding-top:5px">802845461RT0001
                                </td>
                            </tr> --}}
                            <tr>
                                <td style="padding-top: 0;">GST/ HST : 13.000%</td>
                                <td style="text-align: end; font-weight: 600; padding-top:5px">${{ $order->tax_total }}
                                </td>
                            </tr>
                            {{-- <tr>
                                <td style="padding-top: 0;">PST : 00.000%</td>
                                <td style="text-align: end; font-weight: 600; padding-top:5px">$0.00</td>
                            </tr> --}}
                            <tr>
                                <td style="padding-top: 0; font-weight: 600; font-size: 16px;">Paid :</td>
                                <td style="text-align: end; font-weight: 600; font-size: 16px; padding-top:5px">
                                    <span style="border-bottom: 1px solid #323232;">${{ $order->grand_total }}</span>
                                </td>
                            </tr>

                            <tr>
                                <td style="padding-top: 0;">Balance : <br>
                                    <span style="font-size: 12px; color: #004EA5;">After Returns and Restocking
                                        Charges</span>
                                </td>

                                <td style="text-align: end; font-weight: 600; padding-top:5px">$0.00</td>
                            </tr>
                            <tr>
                                <td style="padding-top: 0;">Total Returns :</td>
                                <td style="text-align: end; font-weight: 600; padding-top:5px">$0.00</td>
                            </tr>

                            <tr style=" background-color: #e6e6e6;">
                                <td style=" font-size: 16px; font-weight: 600;">Grand Total:</td>
                                <td style="text-align: end;padding-top: 10px;font-size: 16px; font-weight: 600">
                                    ${{ $order->grand_total }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
@endsection
