@extends('layouts.app')

@section('content')
    @if(Auth::check())
        <div class="container">
            <private-chat-component
                    :user="{{ Auth::user() }}"
                    route_messages="{{ route('messages') }}"
                    channel="{{ $channel }}">
            </private-chat-component>
        </div>
    @endif
@endsection