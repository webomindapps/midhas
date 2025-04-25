<x-app-layout>
    <div class="container secs">
        <div class="mx-auto col-lg-5 col-md-11 rounded shadow">
            <div class="p-3">
                <p>Your Account is not verified yet please verify first</p>
                <form action="{{ route('customer.verify') }}" method="post">
                    @csrf
                    <button type="submit" style="padding: 10px 20px; background:#c33094;border:0;border-radius:5px;font-weight:600;color:aliceblue;">Resend Verify Mail</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>