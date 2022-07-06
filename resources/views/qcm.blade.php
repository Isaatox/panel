@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('qcm.store', ['qcm' =>  $qcm]) }}">
        @csrf
    <div class="grid grid-cols-1 grid md:grid-cols-2 ">
        @php $i3 = 0; @endphp

    @foreach($qcm->questions() as $question)
            @php $i1 = $question->id; @endphp
            @php $i3++; @endphp
        
            @php $random = rand(10, 10000); @endphp
            <div class="p-6">
                @if($loop->first)

                    <div class="flex items-center">
                        <div class="ml-4 text-lg leading-7 font-semibold"><a href="#" class=" text-gray-900 text-dark">QCM</a></div>
                    </div>
                @endif

                    @if($loop->index == 1)
                        <div class="flex items-center">
                            <div class="ml-4 text-lg leading-7 font-semibold"><a href="#" class=" text-gray-900 text-white">&nbsp;</a></div>
                        </div>
                    @endif
            <b class="mt-2 mb-3"> Question #{{$i3 }} : {{ $question->answer }}</b>

        @foreach(explode(',', $question->replies) as $i2 => $reply)
        
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" name="{{ $i2 + 1 }}-{{ $i1 }}-{{ $random }}" id="{{ $i2 + 1 }}-{{ $i1 }}-{{ $random }}">
                    <label class="form-check-label" for="{{ $i2 + 1 }}-{{ $i1 }}-{{ $random }}">{{ $reply }}</label>
                </div>

            @endforeach
            </div>

        @endforeach

        <div class="p-6">
            <button class="btn btn-primary">Soumettre mon QCM</button>
        </div>


    </div>
    </form>
@endsection
