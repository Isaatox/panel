@extends('layouts.app')

@section('content')

    <div class="grid grid-cols-1 md:grid-cols-2">

        <div class="p-6 bg-primary">

            <div class="">
            
                <div class="mt-2 text-sm text-align-center" style="margin-top: 50px;">
                    <p style="
    font-size: 16px;
    text-align: center;
">
                        Bienvenue sur le panel de W:RP ! Il faudra vous inscrire pour pouvoir accéder au formulaire. Si vous réussissez, vous serez automatiquement whitelist. Il faut réussir avec minimum 10 bonnes réponses sur 15.
                    </p>

                </div>

                <div class="justify-center flex">
                    <a href="{{ route('login') }}" class="btn underline btn-primary2 text-center mt-2 ">Se connecter</a>
                </div>
            </div>

        </div>
        <div class="p-6">
            <div class="flex items-center">
                <div class="ml-4 text-lg leading-7 font-semibold"><a href="#" class=" text-gray-900 text-white">Changement de mot de passe</a></div>
            </div>
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Adresse E-Mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Mot de passe</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Confirmation</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Réinitaliser
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
@endsection
