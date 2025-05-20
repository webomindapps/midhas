<html>

<head>
    <meta charset="utf-8" />
    <title>Tax Invoice</title>

    <style>
        * {
            box-sizing: border-box;
        }

        a {
            text-decoration: none;
            color: #000;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #c1c1c1 !important;
            padding: 10px;
            word-break: keep-all;
        }

        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            font-size: 16px;
        }

        .h4-14 h4 {
            font-size: 12px;
            margin-top: 0;
            margin-bottom: 5px;
        }

        .img {
            margin-left: "auto";
            margin-top: "auto";
            height: 30px;
        }

        pre,
        p {
            padding: 0;
            margin: 0;
        }

        table {
            font-family: 'Roboto', sans-serif;
            width: 100%;
            border-collapse: collapse;
            padding: 1px;
        }

        .hm-p p {
            text-align: left;
            padding: 1px;
            padding: 5px 4px;
            font-family: 'Roboto', sans-serif;
        }

        td,
        th {
            text-align: left;
            padding: 8px 6px;
        }

        .table-b td,
        .table-b th {
            border: 1px solid #363636;
        }

        th {
            /* background-color: #ddd; */
        }

        .hm-p td,
        .hm-p th {
            padding: 3px 0px;
        }

        .cropped {
            float: right;
            margin-bottom: 20px;
            height: 100px;
            /* height of container */
            overflow: hidden;
        }

        .cropped img {
            width: 400px;
            margin: 8px 0px 0px 80px;
        }

        .main-pd-wrapper {
            box-shadow: 0 0 10px #ddd;
            background-color: #fff;
            width: 100%;
            margin: 30px auto;
            max-width: 1440px;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #363636;
            padding: 10px;
            font-size: 14px;
        }


        .line {
            height: 4px;
            width: 100%;
            background-color: #000;
            margin: 20px 0;
        }

        .logo-sec {
            margin-top: -7%;
        }

        @media screen and (min-width: 1600px) and (max-width: 3200px) {
            .main-pd-wrapper {
                box-shadow: 0 0 10px #ddd;
                background-color: #fff;
                padding: 0px 30px;
                width: 80%;
                margin: 30px auto;
            }
        }
    </style>
</head>

<body>
    <section class="main-pd-wrapper">

        <table style="background-color: #f58b33; text-align: center;">
            <tbody>
                <tr>
                    <td colspan="2" style="padding: 12px 0px; text-align: center;">
                        <a style="font-size: 14px; color: #fff; font-weight: 200;" href="mailto:1-844-373-5550"> <b>
                                Toll Free : </b>1-844-373-5550 </a>
                    </td>
                    <td colspan="2" style="padding: 12px; text-align: center">
                        <a style="font-size: 14px; color: #fff; font-weight: 200;" href="www.teletime.ca"> <b> Website :
                            </b> www.furniture.to </a>
                    </td>

                    <td colspan="2" style="padding: 12px; text-align: center">
                        <a style="font-size: 14px; color: #fff; font-weight: 200;" href="mailto:info@teletime.ca"> <b>
                                Email : </b>info@tastechnlogoies.com </a>
                    </td>

                </tr>
            </tbody>
        </table>

        <div class="table-wrapper" style="padding: 0 20px;">


            <table style="border-bottom: 4px double #cfcfcf;">
                <tr>
                    <td style="padding-bottom: 0;">
                        <img src="https://www.furniturestore.to/staging/public/frontend/images/midhas_logo.png" alt=""
                            style="width: 220px; padding-top: 10px;">
                        <table>
                            <tbody>

                                <tr>
                                    <td style="font-size: 20px; padding-top: 60px; font-weight: 600; color: #f58b33;">
                                        @yield('title')</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                    <td>
                        <table style="text-align: end; width: 70%; margin-left: auto;">
                            <tbody>
                                <tr>
                                    <td
                                        style="padding: 3px 0px 4px 2px; width: 160px; font-size: 14px; text-align: end;">
                                        <b>Tel :</b>
                                    </td>
                                    <td style="padding: 4px 12px; text-align: Start;">
                                        <a style="color: #000; font-size: 14px; font-weight: 200;"
                                            href="(905) 273-5550"> (905) 273-5550</a>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="padding: 3px 0px 4px 2px; font-size: 14px; text-align: end;">
                                        <b>Fax:</b>
                                    </td>
                                    <td style="padding: 4px 12px; text-align: Start;">
                                        <a style="color: #000; font-size: 14px; font-weight: 200;"
                                            href="(905) 273-5551"> (905) 273-5551 </a>
                                    </td>
                                </tr>
                                <tr style="text-align: end; vertical-align: text-top;">
                                    <td style="padding: 3px 0px 4px  2px; font-size: 14px; text-align: end;">
                                        <b>Address :</b>
                                    </td>
                                    <td
                                        style="padding: 4px 12px 0px 12px; font-weight: 400; font-size: 14px; text-align: Start; color: #000;">
                                        3125 Wolfedale Road <br> Mississauga, ON, <br> L5C 1W1
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </table>


            @yield('contents')

            <hr>

            <table>
                <tbody>

                    <tr>
                        <td style="font-size: 12px; padding: 0; color: #323232;">
                            <ul style="padding-left: 20px;">
                                <li>15 DAYS EXCHANGE IN ORIGINAL CONDITION, 20% RESTOCKING CHARGES APPLY UNLESS PRODUCT
                                    IS
                                    REALY DEFECTIVE.</li>
                                <li>DEPOSITS ON PURCHASE ARE NON-REFUNDABLE.</li>
                                <li>20% ORDER CANCELLATION CHARGE.</li>
                                <li>DELIVERY TERMS: FOR YOUR PROTECTION. DUE TO INSURANCE REGULATIONS, TELETIME DRIVERS
                                    CAN
                                    ONLY DELIVER YOUR GOODS TO YOUR FRONT DOOR. ANY DAMAGE CAUSED BY OUR DRIVERS ON YOUR
                                    PROPERTY, ON GOODS OR TO YOUR PROPERTY IS THE SOLE RESPONSIBILITY OF THE CUSTOMER.
                                    CUSTOMERS CAN INSPECT GOODS ON OR OFF THEIR PROPERTY.</li>
                                <li>
                                    IN CASE CUSTOMER DOES NOT PROVIDE PROPER MEASUREMENTS OR ANY SPECIAL DELIVERY
                                    INSTRUCTIONS RESULTING IN PRODUCT EXCHANGE, $100.00 EXCHANGE DELIVERY CHARGES WILL
                                    APPLY.

                                </li>
                                <li> MISHANDLED PRODUCTS ARE NOT COVERED UNDER WARRANTY.</li>
                                <li>ANY PHYSICAL DAMAGE TO THE PRODUCTS NOT INSPECTED AT THE TIME OF DELIVERY MUST BE
                                    REPORTED WITHIN 24 HOURS.
                                </li>
                                <li>
                                    APPLIANCES, ONCE PLUGGED IN, WILL NOT QUALIFY FOR EXCHANGE OR REFUND, THEY WILL BE
                                    COVERED UNDER MANUFACTURER'S WARRANTY TERMS.
                                </li>

                            </ul>
                        </td>
                    </tr>
                </tbody>
            </table>

            <table style="margin-top: 10px; border-top: 4px double #cfcfcf;">
                <tbody>
                    <tr>
                        <td style="font-size: 20px; padding-top: 20px;">Thanks For Shopping, See You Again</td>
                    </tr>
                    <tr>
                        <td>
                            <table>
                                <tbody>

                                    <tr style="font-size: 14px;">
                                        <th>Accepted By (Name) : </th>
                                        <td>
                                            <p
                                                style="width: 250px; border-bottom: 1px solid #bababa; margin-top: 10px;">

                                            </p>
                                        </td>
                                    </tr>
                                    <tr style="font-size: 14px;">
                                        <th>Signature: </th>
                                        <td>
                                            <p
                                                style="width: 250px; border-bottom: 1px solid #bababa; margin-top: 10px;">

                                            </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td>
                            <table>
                                <tbody>

                                    <tr style="font-size: 14px;">
                                        <th>Customer Note(s): </th>
                                        <td>
                                            <p
                                                style="width: 250px; border-bottom: 1px solid #bababa; margin-top: 10px;">

                                            </p>
                                        </td>
                                    </tr>
                                    <tr style="font-size: 14px;">
                                        <th>Date: </th>
                                        <td>
                                            <p
                                                style="width: 250px; border-bottom: 1px solid #bababa; margin-top: 10px;">
                                            </p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                </tbody>
            </table>

        </div>

    </section>
</body>

</html>
