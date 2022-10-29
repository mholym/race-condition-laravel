<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Answers') }}
        </h2>
    </x-slot>
    @foreach($polls as $poll)
        <div class="py-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <form method="POST" action="/polls/{{$poll->id}}">
                        @csrf
                        <div class="p-6 bg-white border-b border-gray-200">
                            {{$poll->text}}
                        </div>
                        @foreach($poll->answers as $answer)
                            <div class="p-6 bg-white border-b border-gray-200">
                                <span>{{$answer->votes_count}}</span>
                                <span class="pl-2">{{$answer->text}}</span>
                            </div>
                        @endforeach
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</x-app-layout>
