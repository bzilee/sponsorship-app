@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

       <div class="col-sm-12 col-md-10">
           <p class="home-title-center-green">Parrainage à l' IAI Douala</p>
           <p class="home-subtitle-center-white">
                Cérémonie au cours de laquelle deux personnes, le parrain ou la
                marraine et le filleul ou la filleule, s'engagent à se soutenir moralement
                pour suivre des règles d'intégration dans un établissement</p>
            <div class="center s-btn-submitting-group">
                <button id="s-btn-submitting" url="{{ route('register') }}" class="btn s-btn-submitting btn-green btn-rounded"><i class=""></i>
                    {{ __('S\'enregistrer') }}
                </button>
                {{-- <a href="{{ route('user.profile') }}" class="btn s-btn-bg-green btn-rounded btn-show-profile">Voir mon profil</a> --}}
            </div>
            <div class="center thumbnail-logo-iai" id="thumbnail-logo-iai">
                <img src="{{ asset('images/logo/logo-IAI-Cameroun-good1.png') }}" alt="Logo IAI" height="60px">
            </div>
        </div>
    </div>
</div>
@endsection
