@extends('layouts.app')

@section('content')
    <div class="container">
        <chat-component route_messages="{{route('messages')}}"></chat-component>
    </div>
@endsection