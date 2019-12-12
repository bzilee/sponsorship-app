@extends('layouts.app')

@section('title') SponsorshipAPP Process @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center" >
        <div class="col-md-10 col-lg-10 col-sm-12 flex-center group-percent-evolution">
            <p class="typo-comic-20px s-color-green">Evolution <i>50 %</i></p>
        </div>
        <div class="col-md-10 col-lg-12 col-sm-12 flex-center group-affiliate">

            <div class="row">
                <div class="col-lg-1 col-md-1">
                    <div class="col-lg-5  group-children">
                        <img class="all-chilren" src="{{ asset('images/123.jpg') }}" alt="">
                    </div>
                    <div class="col-lg-5 group-children">
                            <img class="all-chilren" src="{{ asset('images/123.jpg') }}" alt="">
                    </div>
                    <div class="col-lg-5 group-children">
                            <img class="all-chilren" src="{{ asset('images/123.jpg') }}" alt="">
                    </div>
                </div>
                <div class="animated bounceInLeft bounceIn col-lg-5 col-md-5 offset-lg-1 offset-md-1 group-parent">
                    <img class="parent-img" src="{{ asset('images/123.jpg') }}" alt="">
                </div>

                <div class="animated bounceInRight col-lg-5 col-md-5 group-child">
                    <img class="child-img" src="{{ asset('images/124.jpg') }}" alt="">
                </div>
            </div>

        </div>
        <div class="col-md-10 col-lg-10 col-sm-12 flex-center">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                        <p class="typo-comic name-parent">Paul Alain</p>
                </div>
                <div class="col-lg-6 col-md-6">
                        <p class="typo-comic name-child">Paul Alain</p>
                </div>
            </div>
        </div>
        <div class="center thumbnail-logo-iai " id="thumbnail-logo-iai">
                <img src="{{ asset('images/logo/logo-IAI-Cameroun-good1.png') }}" alt="Logo IAI" height="60px">
        </div>
    </div>

</div>
@endsection
