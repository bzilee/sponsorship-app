@extends('layouts.appNoHeader')

@section('content')
<div class="container">
    <div class="flex-center position-ref ">
        <div class="code">
            <p>
                <strong class="s-color-green"><font size="30px"> 404</font></strong>
            </p>
            Tu Ndem seulement !!! <br>Le chemin auquel tu veux accéder est incorrect ou n'est plus disponible. <br> Retourne à <a class="s-color-green"href="{{ route('home') }}">la page d'acceuil.</a> </div>
        </div>
    </div>
    <div class="center thumbnail-logo-iai" id="thumbnail-logo-iai">
        <img src="{{ asset('images/logo/logo-IAI-Cameroun-good1.png') }}" alt="Logo IAI" height="60px">
    </div>
</div>
@endsection
