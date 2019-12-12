@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header center s-color-green">{{ __('Inscription') }}</div>

                <div class="card-body">
                    <p>NB: Les champs mentionnés par des <strong>*</strong> sont obligatoires.</p>
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nom *') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Prénom *') }}</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sexe" class="col-md-4 col-form-label text-md-right">{{ __('Sexe *') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" id="sexe" placeholder="nom@abc.com" name="sexe">
                                    <option value="Masculin">Homme</option>
                                    <option value="Feminin">Femme</option>
                                </select>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="filiere" class="col-md-4 col-form-label text-md-right">{{ __('Filière *') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" id="sexe"  name="filiere">
                                    <option value="GL1">Génie Logiciel L1</option>
                                    <option value="GL2">Génie Logiciel L2</option>
                                    <option value="SR1">Système et Réseau L1</option>
                                    <option value="SR2">Système et Réseau L2</option>
                                </select>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('N°Tél (orange) *') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="tel" class="form-control @error('phone_orange') is-invalid @enderror" name="phone_orange" value="{{ old('phone_orange') }}" required autocomplete="phone_orange" autofocus>

                                @error('phone_orange')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone2" class="col-md-4 col-form-label text-md-right">{{ __('Tél 2 (Facultatif)') }}</label>

                            <div class="col-md-6">
                                <input id="phone2" type="tel" class="form-control @error('phone2') is-invalid @enderror" name="phone2" value="{{ old('phone2') }}"  autocomplete="phone2" autofocus>

                                @error('phone2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone3" class="col-md-4 col-form-label text-md-right">{{ __('Tél 3 (Facultatif)') }}</label>

                            <div class="col-md-6">
                                <input id="phone3" type="tel" class="form-control @error('phone3') is-invalid @enderror" name="phone3" value="{{ old('phone3') }}"  autocomplete="phone3" autofocus>

                                @error('phone3')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Addresse e-mail *') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mot de passe *') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" >

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmer le mot de passe *') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        {{--  --}}
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Photo de profil *') }}</label>
                            <div class="col-md-6 ">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input form-control @error('avatar') is-invalid @enderror" id="validatedCustomFile " name= "avatar" required>
                                    <label class="custom-file-label " for="validatedCustomFile">Choisir un fichier ...</label>
                                    @error('avatar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>

                        </div>
                        {{--  --}}
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-green">
                                    {{ __('Soumettre') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
