@extends('admin.layout.app')

@section('contents')
    <div class="container-fluid">
        <div class="row pt-3 pb-2 border-bottom">
            <div class="col-lg-4">
                <h3>Dashboard</h3>
            </div>
            <div class="col-lg-8 text-end ms-auto">
                <div class="row justify-content-end">
                    <div class="col-lg-5">
                        <div class="cdate">
                            <input type="date" class="form-control" name="start_date" id="start_date">
                        </div>
                    </div>
                    <div class="col-lg-2 text-center my-auto">
                        <span class="fw-semibold fs-6">To</span>
                    </div>
                    <div class="col-lg-5">
                        <div class="cdate">
                            <input type="date" class="form-control" name="end_date" id="end_date">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row pb-4 px-1">
            <div class="dashboard-stats">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card shadow-sm mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Total Users</h5>
                                <p class="card-text">Total number of users registered on the platform.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
