@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

       <div class="col-sm-12 col-md-10">
            <p class="home-title-center-green">Parrainage à l' IAI Douala</p>
            <p class="countdown-subtitle-center-white">
                Cérémonie dans
            </p>
            <div class="center s-btn-submitting-group countdown-main wow pulse animated" data-wow-iteration="infinite" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-iteration-count: infinite; animation-name: pulse;">
                <countdown date="{{ $count_down_date }}" url="{{ route('sponsorship.start') }}" ></countdown>
            </div>
            <div class="center thumbnail-logo-iai">
                <img src="{{ asset('images/logo/logo-IAI-Cameroun-good1.png') }}" alt="Logo IAI" height="60px">
            </div>
        </div>
    </div>
</div>
@endsection
