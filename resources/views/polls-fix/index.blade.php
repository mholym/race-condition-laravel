<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Polls v2') }}
        </h2>
    </x-slot>

    @if(session()->has('success'))
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200" style="background-color: lightgreen;">
                        {{session('success')}}
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if(session()->has('failure'))
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200" style="background-color: lightcoral;">
                        {{session('failure')}}
                    </div>
                </div>
            </div>
        </div>
    @endif

    @foreach($polls as $poll)
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <form method="POST" action="/polls-fix/{{$poll->id}}">
                        @csrf
                        <div class="p-6 bg-white border-b border-gray-200">
                            {{$poll->text}}
                        </div>
                        @foreach($poll->answers as $answer)
                            <div class="p-6 bg-white border-b border-gray-200">
                                <input class="form-check-input" type="radio" name="answer" value={{ $answer->id }}>
                                <span class="pl-2">{{$answer->text}}</span>
                            </div>
                        @endforeach
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</x-app-layout>
