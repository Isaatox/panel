@extends('layouts.app')

@section('content')

    <div class="grid grid-cols-1 md:grid-cols-2">

        <div class="p-6 bg-primary">

            <div class="" >

                <div class="mt-2" style="margin-top: 50px;text-align: center;">

                    <b style="text-align: center;" class="text-lg">Créer un compte</b>

<p style="
    font-size: 16px;
    text-align: center;
">

                        Bienvenue sur le panel de W:RP ! Il faudra vous inscrire pour pouvoir accéder au formulaire. Si vous réussissez, vous serez automatiquement whitelist. Il faut réussir avec minimum 10 bonnes réponses sur 15.
                    </p>

                </div>
                <div class="justify-center flex">
                    <a href="{{ route('register') }}" class="btn underline btn-primary2 text-center mt-2 ">S'inscrire</a>
                </div>
            </div>

        </div>
        <div class="p-6">
            <div class="flex items-center">
                <div class="ml-4 text-lg leading-7 font-semibold"><a href="#" class=" text-gray-900 text-dark">Connexion</a></div>
            </div>

                <div class="mt-2 text-gray-600 text-gray-400 text-sm">

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Nom d'utilisateur</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Mot de passe</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        Se souvenir de moi
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Se connecter
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        Mot de passe oublié ?
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
        </div>

        </div>
@endsection
