@extends('layouts.app')

@section('content')
    <ul>
        @foreach($badges as $badge)
            <li><a href="{{ route('badge.show', $badge) }}">{{ $badge->name }}</a></li>
        @endforeach
    </ul>
@endsection