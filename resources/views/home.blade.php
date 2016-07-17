@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <nav class="tabs">
                <ul>
                    <li><a href="#" class="uppercase">Popular</a></li>
                    <li><a href="#" class="uppercase">New</a></li>
                    <li><a href="#" class="uppercase">Bumped</a></li>
                    <li><a href="#" class="uppercase">Notices</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <hr>
    <ul>
        @foreach($bumped as $thread)
            <li><a href="{{ route('thread.show', $thread) }}">{{ $thread->name }}</a></li>
        @endforeach
    </ul>
    <hr>
@endsection
