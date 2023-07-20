@extends('layouts.app')
@section('title', 'Choose Account Type')
@section('content')
    <section class="section-account-type text-center py-4">
        <img src="{{ asset('assets/images/loginImg.png') }}" alt="background-image">
        <h5 class="text-dark pb-2">Choose your account type</h5>
        <div class="card mx-5 bg-grey text-dark">
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-sm-3 px-4">
                        <a href="{{ route('employee.login') }}">
                            <div class="account-type">
                                <img src="{{ asset('assets/images/loginType/employee.png') }}" alt="Employee">
                                <h5 class="text-white">Employee</h5>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-3 px-4">
                        <a href="{{ route('hospital.login') }}">
                            <div class="account-type">
                                <img src="{{ asset('assets/images/loginType/Hospital.png') }}" alt="Hospital">
                                <h5 class="text-white">Hospital</h5>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-3 px-4">
                        <a href="#">
                            <div class="account-type">
                                <img src="{{ asset('assets/images/loginType/Claimant.png') }}" alt="Claimant">
                                <h5 class="text-white pt-2">Claimant</h5>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-3 px-4">
                        <a href="{{ route('associate-partner.login') }}">
                            <div class="account-type">
                                <img src="{{ asset('assets/images/loginType/salesPartner.png') }}" alt="salesPartner">
                                <h5 class="text-white">Sales Partner</h5>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-3 px-4">
                        <a href="{{ route('associate-partner.login') }}">
                            <div class="account-type">
                                <img src="{{ asset('assets/images/loginType/vendor.png') }}" alt="vendor">
                                <h5 class="text-white">Vendor</h5>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-3 px-4">
                        <a href="#">
                            <div class="account-type">
                                <img src="{{ asset('assets/images/loginType/Insurer.png') }}" alt="Insurer">
                                <h5 class="text-white">Insurer</h5>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-3 px-4">
                        <a href="#">
                            <div class="account-type">
                                <img src="{{ asset('assets/images/loginType/tpa.png') }}" alt="tpa">
                                <h5 class="text-white">TPA</h5>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
