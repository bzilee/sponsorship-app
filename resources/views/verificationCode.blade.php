@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

       <div class="col-sm-12 col-md-10">
           <p class="verification-title-center-green">Vérification du numéro</p>
           <p class="verification-subtitle-center-white">
            Un code de vérification a été(ou avait été) envoyé au numéro <strong>{{ $phone_number }}</strong>.
            Récupérez le code et saisissez le ci-dessous. Si vous ne l'avez plus, contacter vos administrateurs.</p>
            <div class="center btn-verification-group">
                <form method="POST" action="{{ route('code.validation', ['code_identification' => $code_identification]) }}" >
                        @csrf
                    <div class="form-group row">
                        <div class="col-md-8 offset-md-2">
                            <input id="codeVerification" type="number" class="form-control btn-rounded @error('codeVerification') is-invalid @enderror" name="codeVerification" value="{{ old('name') }}" required autocomplete="codeVerification" placeholder="Code de vérification" autofocus>

                            @error('codeVerification')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">

                            <div class="col-md-8 offset-md-2">
                                    <button type="submit" class="btn btn-code-verification btn-rounded  btn-green">
                                            {{ __('Vérifier') }}
                                    </button>
                            </div>
                    </div>

            </div>
            <div class="center thumbnail-logo-iai" id="thumbnail-logo-iai">
                <img src="{{ asset('images/logo/logo-IAI-Cameroun-good1.png') }}" alt="Logo IAI" height="60px">
            </div>
        </div>
    </div>
</div>
@endsection
