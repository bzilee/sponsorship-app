@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
            <div class="row card-body box-profile justify-content-center content-profile">
                <div class="details-profile-proposer float-md-left">
                    <div>

                        <img class="profile-user-img user-image rounded-circle"
                                        src="{{ $photo_profile }}"
                                        alt="Image utilisateur">
                    </div>
                    <div class="text-center content-details">
                            <p class="text-muted">Nom et Prénom :</p>
                            <p class="text-muted">Genre :</p>
                            <p class="text-muted">Filière :</p>
                            <p class="text-muted">Adresse Email :</p>
                            <p class="text-muted">Quartier de résidence :</p>
                            <p class="text-muted">Téléphone: </p>
                    </div>
                </div>

                <div class="details-profile-proposer float-md-riht">
                    <div>
                        <img class="profile-user-img user-image rounded-circle"
                                        src="{{ asset('images/user.JPG') }}"
                                        alt="Image utilisateur">
                    </div>
                    <div class="text-center content-details">
                            <p class="text-muted">Nom et Prénom :</p>
                            <p class="text-muted">Genre :</p>
                            <p class="text-muted">Filière :</p>
                            <p class="text-muted">Adresse Email :</p>
                            <p class="text-muted">Quartier de résidence :</p>
                            <p class="text-muted">Téléphone: </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
