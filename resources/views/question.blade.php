@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('question.edit', ['question' =>  $question]) }}">
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
        <div class="grid grid-cols-1">
            <div class="p-6">

            <div class=" mb-3">
                <label for="answer" class="col-md-4 col-form-label text-md-end">Question</label>
                <div class="col-md-12">
                    <input id="answer" type="text" class="form-control " name="answer" value="{{ old('answer') ?? $question->answer }}" required autocomplete="answer" autofocus>
                </div>
            </div>
                <div class=" mb-3">

                <label for="replies" class="col-md-4 m-3 col-form-label text-md-end">Réponses possible (séparé par des virgules)</label>
                <div class="col-md-12">
                    <textarea id="replies" type="text" class="form-control " name="replies" style="width: 1000px; height: 100px;">{{ old('replies') ?? $question->replies }}</textarea>
                </div>

                </div>
                <div class=" mb-3">

                <label for="validate" class="col-md-4 col-form-label text-md-end">Numero de question valide (séparé par des virgules)</label>
                <div class="col-md-12">
                    <input id="validate" type="text" class="form-control " name="validate" value="{{ old('validate') ?? $question->validate }}" required autocomplete="validated">
                </div>
                </div>
            </div>
            </div>


        <div class="p-6">
            <button class="btn btn-primary">Sauvegarder</button>
        </div>
    </form>
@endsection
