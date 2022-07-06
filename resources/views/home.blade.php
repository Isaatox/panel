@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-1">
        <div class="p-6">
            <div class="flex items-center">
                <div class="ml-4 text-lg leading-7 "><a href="#" class=" text-gray-900 text-dark">Dashboard</a>
                </div>
            </div>
                    @if (session('status'))
                        <div class="alert alert-info" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    Connecté en tant que {{ Auth::user()->username }}, {{ Auth::user()->username_discord ? '(' . Auth::user()->username_discord . ')' : '' }}
            @if (Auth::user()->discord_id == null)
                <a class="btn btn-discord" href="{{ route('discord') }}">Connexion via discord</a>
                @else

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Valide</th>
                    <th scope="col">Questions validées</th>
                    <th scope="col">Temps</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($qcm as $qcm_)
                <tr>
                    <td>
                        @if($qcm_->successfully)
                            <p class="text-success">Validé</p>
                            @elseif ($qcm_->validatedcount == null)
                            <p class="text-warning">En attente</p>
                        @else
                            <p class="text-danger">Non validé</p>
                        @endif
                    </td>
                    <td><p class="text-align-center flex">{{ $qcm_->validatedcount ?? 'En attente'}}</p></td>
                    <td><p class="text-align-center flex">{{ $qcm_->diff() }}</p></td>
                    <td>
                        @if ($qcm_->validatedcount == null)
                        <a class="btn btn-primary btn-sm" href="{{ route('qcm', ['qcm' => $qcm_->id]) }}">Voir le QCM</a>
                        @endif
                    </td>
                </tr>
                @endforeach
                @if ($qcm->isEmpty())
                    <tr>
                        <td colspan="6">Aucun QCM rempli.</td>
                    </tr>
                    @endif
                </tbody>
            </table>

            @endif
            <form method="POST" action="{{ route('logout') }}" style="display: inline-block">
                @csrf
                <button class="btn btn-danger">Se déconnecter</button>
                <a class="btn btn-primary btn-sm {{ count($qcm) == 3 ? 'disabled' : '' }}" href="{{ route('qcm.create') }}" {{ count($qcm) == 3 ? 'disabled' : '' }}>Faire le QCM ({{ count($qcm) }} / 3)</a>

            </form>
        </div>
            </div>
@endsection
