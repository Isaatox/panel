@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2">
        <div class="p-6">
            <div class="flex items-center">
                <div class="ml-4 text-lg leading-7 "><a href="#" class=" text-gray-900 text-dark">QCM</a>
                </div>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Valide</th>
                        <th scope="col">Utilisateur</th>
                        <th scope="col">Temps</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($qcm as $qcm_)
                        <tr>
                            <td>
                                @if ($qcm_->successfully)
                                    <p class="text-success">Validé</p>
                                @elseif ($qcm_->validatedcount == null)
                                    <p class="text-warning">En attente</p>
                                @else
                                    <p class="text-danger">Non validé</p>
                                @endif
                            </td>
                            <td>
                                <p class="text-align-center flex">{{ $qcm_->user()->username }}</p>
                            </td>
                            <td>
                                <p class="text-align-center flex">{{ $qcm_->diff() }}</p>
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

        </div>
        <div class="p-6">
            <div class="flex items-center">
                <div class="ml-4 text-lg leading-7 "><a href="#" class=" text-gray-900 text-dark">Utilisateurs</a>
                </div>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">E-mail</th>
                        <th scope="col">Utilisateur</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>
                                {{ $user->email }}
                            </td>
                            <td>
                                <p class="text-align-center flex">{{ $user->username }} ({{ $user->username_discord }})
                                </p>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
    <div class="grid grid-cols-1">
        <div class="p-6">
            <div class="flex items-center">
                <div class="ml-4 text-lg leading-7 "><a href="#" class=" text-gray-900 text-dark">Questions</a>
                    <a class="btn btn-primary btn-sm"
                        href="{{ route('question.view') }}">Ajouter</a>
                </div>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Question</th>
                        <th scope="col">Edition</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($questions as $question)
                        <tr>
                            <td>
                                {{ $question->answer }}
                            </td>
                            <td><a class="btn btn-primary btn-sm"
                                    href="{{ route('question.edit', ['question' => $question->id]) }}">Editer</a>
                                <a class="btn btn-danger btn-sm"
                                    href="{{ route('question.delete', ['question' => $question->id]) }}">Supprimer</a>
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

        </div>

    </div>
@endsection
