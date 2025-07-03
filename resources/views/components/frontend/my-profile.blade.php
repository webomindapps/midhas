<div class="container section">
    <div class="row g-4 p-3 ps-md-0 p-lg-0">
        <div class="col-md-5 col-lg-3">
            <div class="bg-white border rounded  p-3 list-sec">
                <h6>Hi, {{ Auth::user()->name }} </h6>
                <small>You’ve earned 0 points</small><br>
                <a href="#" class="d-block text-decoration-none">Reward Points</a>
                <hr>
                <ul class="nav flex-column overview-sec">
                    <li class="nav-item d-flex align-items-center"><i class="fa-solid fa-house"></i><a
                            class="nav-link active" href="{{ route('customer.profile') }}">Account Overview</a></li>
                    <li class="nav-item d-flex align-items-center"><i class="fas fa-box"></i> <a class="nav-link"
                            href="{{ route('orders.index') }}">Order History</a></li>
                    <li class="nav-item d-flex align-items-center"><i class="fas fa-clock"></i><a class="nav-link"
                            href="#">Pre-Orders</a></li>
                    <li class="nav-item d-flex align-items-center"><i class="fas fa-user"></i><a class="nav-link"
                            href="{{ route('customer.details') }}">My Details</a></li>
                    <li class="nav-item d-flex align-items-center"><i class="fas fa-lock"></i><a class="nav-link"
                            href="{{ route('customer.resetpassword') }}">Change Password</a></li>
                    <li class="nav-item d-flex align-items-center"><i class="fas fa-address-book"></i><a
                            class="nav-link" href="{{route('customer.address')}}">Address Book</a></li>
                    <li class="nav-item d-flex align-items-center"><i class="fas fa-heart"></i><a class="nav-link"
                            href="#">Saved Baskets</a></li>
                    <li class="nav-item d-flex align-items-center"><i class="fas fa-user-friends"></i><a
                            class="nav-link" href="#">Introduce a Friend</a></li>
                    <li class="nav-item d-flex align-items-center"><i class="fas fa-bullhorn"></i> <a class="nav-link"
                            href="#">Marketing Preferences</a></li>
                    <li class="nav-item d-flex align-items-center"><i class="fas fa-headset"></i> <a class="nav-link"
                            href="#">Customer Services</a></li>
                    <li class="nav-item d-flex align-items-center"><i class="fas fa-sign-out-alt"></i><a
                            class="nav-link" href="{{route('customer.logout')}}">Sign Out</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-7 col-lg-9">
            {{ $slot }}
        </div>
    </div>
</div>
