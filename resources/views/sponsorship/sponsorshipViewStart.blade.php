@extends('layouts.app')

@section('content')
<audio id="player"  loop src="http://192.168.8.2/Audios/Pirates-of-the-Caribbean_Dea.mp3"></audio>
<div class="container" id="sponsorship-mount">

    <div class="row justify-content-center" id="cover">

       <div class="col-sm-12 col-md-10" >
            <p class="home-title-center-green">Parrainage à l' IAI Douala</p>

            <div class="center s-btn-submitting-group ">

                @if ($show_button)
                    <a href="{{ route('register') }}" class="btn s-btn-submitting btn-green btn-rounded" id="btn-start-sponsorship">
                        {{ __('Démarrer') }}
                    </a>
                    <div class="lds-spinner" id="admin-loader" style="display:none;">
                            <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
                    </div>
                @else
                    <div class="lds-spinner" id = "client-loader">
                        <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>
                    </div>
                    <p class="ic-waiting" id="text-wait">
                        Patienter svp ...
                    </p>
                @endif
                <div class="simple-countdown" id="simple-countdown">
                    <single-count-down time="10" ></single-count-down>
                </div>
            </div>
            <div class="center thumbnail-logo-iai">
                <img src="{{ asset('images/logo/logo-IAI-Cameroun-good1.png') }}" alt="Logo IAI" height="60px">
            </div>
        </div>

    </div>
    <sponsorship></sponsorship>
</div>
@endsection
