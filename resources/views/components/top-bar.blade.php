<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="row top_bar bg-white shadow-sm">
                <div class="col-lg-10 left-area my-auto">
                </div>
                <div class="col-lg-2 right-area">
                    <h6 class="me-3 pt-2">{{ auth('admin')->user()->name }}</h6>
                    <div class="profile-icon">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTscz0eljIO4sQ0qkfpLJrgtl6Kvryp-DA-Hw&usqp=CAU"
                            alt="">
                    </div>
                    <ul class="profile-drop" style="display: none;">
                        <li>
                            <form action="{{ route('admin.logout') }}" id="logoutForm" method="POST">
                                @csrf
                                <a onclick="document.getElementById('logoutForm').submit()">Logout</a>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
