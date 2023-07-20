@extends('layouts.app')
@section('title', 'Welcome to Claimstack')
@section('content')
    <section class="banner px-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 mt-5">
                    <h1 class="text-primary banner-heading">Manage</h1>
                    <h1 class="text-danger banner-heading">Insurance Claims</h1>
                    <h1 class="text-dark banner-subheading">Digitally.</h1>
                </div>
                <div class="col-sm-6 mt-5">
                    <img class="img-fluid" src="{{ asset('assets/images/home1.png') }}" alt="banner">
                </div>
            </div>
        </div>
    </section>
    <section class="section-two py-4">
        <img class="section-two-bg" src="{{ asset('assets/images/logos/logo_sm.png') }}" alt="background-image">
        <h1 class="coming-soon">Coming Soon...</h1>
    </section>
@endsection
