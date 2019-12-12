@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card">
                <div class="card-header center s-color-green">
                    <strong>{{ __('Mon profil') }}</strong>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-4 col-lg-4 user-image flex-center">   {{-- profile-image float-left--}}
                            <img class="profile-user-img  rounded-circle" src="{{ Storage::url($user->photo) }}" alt="Image utilisateur">
                        </div>

                        <div class="col-sm-12 col-md-8 col-lg-8">
                            <div class="col-sm-12 center s-name-profile hidden-name">
                                    <strong>{{ $user->name}}</strong>
                            </div>
                            <p class="text--green profil-items hidden-label-name">
                                <label class="label-profile" for="">
                                    Nom et Prénom :
                                </label>
                                {{ ucwords($user->name)}}
                            </p>
                            <p class="text--green profil-items">
                                <label class="label-profile" for="">
                                        Genre :
                                </label>
                                {{      $user->sexe }}
                            </p>
                            <p class="text--green profil-items">
                                <label class="label-profile" for="">
                                    Filière :
                                </label>
                                {{ $user->filiere }}
                            </p>
                            <p class="text--green profil-items">
                                <label class="label-profile" for="">
                                    Adresse Email :
                                </label>
                                {{ $user->email }}
                            </p>
                            <p class="text--green profil-items">
                                    <label class="label-profile" for="">
                                            Adresse Email :
                                    </label>
                            </p>
                        </div>
                    </div>
                    <div class="btn-home-profile">
                        <button id="home-page" url="{{ route('root')}}" class="btn btn-block btn-success btn-lg btn-rounded update-btn">
                            Retour à l'accueil
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
