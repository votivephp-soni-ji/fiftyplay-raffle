@extends('layout.main')

@section('title', 'Event Creation')

@section('content')

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h4 class="mb-sm-0">Form Layout</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                                <li class="breadcrumb-item active">Form Layout</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">

                    <form action="javascript:void(0);">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="firstNameinput" class="form-label">First Name</label>
                                    <input type="text" class="form-control" placeholder="Enter your firstname"
                                        id="firstNameinput">
                                </div>
                            </div><!--end col-->
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="lastNameinput" class="form-label">Last Name</label>
                                    <input type="text" class="form-control" placeholder="Enter your lastname"
                                        id="lastNameinput">
                                </div>
                            </div><!--end col-->
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="compnayNameinput" class="form-label">Company Name</label>
                                    <input type="text" class="form-control" placeholder="Enter company name"
                                        id="compnayNameinput">
                                </div>
                            </div><!--end col-->
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="phonenumberInput" class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" placeholder="+(245) 451 45123"
                                        id="phonenumberInput">
                                </div>
                            </div><!--end col-->
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="emailidInput" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" placeholder="example@gamil.com"
                                        id="emailidInput">
                                </div>
                            </div><!--end col-->
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="address1ControlTextarea" class="form-label">Address</label>
                                    <input type="text" class="form-control" placeholder="Address 1"
                                        id="address1ControlTextarea">
                                </div>
                            </div><!--end col-->
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="citynameInput" class="form-label">City</label>
                                    <input type="email" class="form-control" placeholder="Enter your city"
                                        id="citynameInput">
                                </div>
                            </div><!--end col-->
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="ForminputState" class="form-label">State</label>
                                    <select id="ForminputState" class="form-select">
                                        <option selected>Choose...</option>
                                        <option>...</option>
                                    </select>
                                </div>
                            </div><!--end col-->
                            <div class="col-lg-12">
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </form>

                </div>

            </div>

        </div>
        <!-- container-fluid -->
    </div>

@endsection
