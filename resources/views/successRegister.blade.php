@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <p class="col-sm-12 center">
            <i class="ion-ios-checkmark-outline icon-44 s-color-green style-icon-success"></i>
        </p>
        <p class="col-sm-10 col-lg-10 text-feliciation">
            Félicitation {{ $last_name_user }}, votre profil est désormais activé pour le parrainage.
        </p>
        <div class="col-12 text-feliciation">
            <div class="row center flex-center buttons-redirect-lg">
                <button id="home-page" url="{{ route('root') }}" class="btn s-btn-bg-green btn-rounded text--white col-sm-12 col-md-3 col-lg-3">Retour à l'accueil</button>
           <button id="show-profile" url="{{ route('user.profile') }}" class="btn s-btn-bg-green btn-rounded text--white btn-show-profile col-sm-12 col-md-3 offset-md-1 col-lg-3 offset-lg-1 margin-top-768w">Voir mon profil</button>
            </div>
        </div>
        <div class="center thumbnail-logo-iai" id="thumbnail-logo-iai">
            <img src="{{ asset('images/logo/logo-IAI-Cameroun-good1.png') }}" alt="Logo IAI" height="60px">
        </div>
    </div>
</div>
@endsection
