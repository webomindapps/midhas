<x-frontend.page>
    <x-slot:css>
        <style>
            .order-success {
                max-width: 40%;
                padding: 10px;
                margin: 10px auto;
                background: #0045a54a;
                border-radius: 10px;
                height: 250px;
            }

            .order-success p {
                font-size: 20px;
            }

            .order-success p span {
                font-size: 30px;
            }


            .success_message {
                border-radius: 15px;
                padding: 30px;
            }

            .success_message img {
                width: 60%
            }
        </style>
    </x-slot:css>

    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mx-auto">
                    <div class="success_message border bg-white text-center">
                        <img src="./imgs/success-tick.gif" class="img-fluid" alt="">
                        <h5>Your order id is: <span class="text-success fw-bold"> </span> </h5>
                        <h3>Your order has been confirmed</h3>

                        <p>
                            You will receive an order confirmation email with details of your order and a link to track
                            your process.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-frontend.page>
