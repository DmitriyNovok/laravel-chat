@extends('layouts.app')

@section('content')
    <div class="container">
        <private-chat-component
                route_messages="{{ route('messages') }}"
                channel="{{ $channel }}">
        </private-chat-component>
    </div>
@endsection