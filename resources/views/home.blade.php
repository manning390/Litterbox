@extends('layouts.app')

@section('content')
    <ul class="nav cl-nav-pills">
        <li role="presentation" class="active"><a href="#" class="uppercase">Bumped</a></li>
        <li role="presentation"><a href="#" class="uppercase">Popular</a></li>
        <li role="presentation"><a href="#" class="uppercase">New</a></li>
        <li role="presentation" class="pull-right"><a href="#" class="uppercase">Notices</a></li>
    </ul>
    @foreach($bumped as $thread)
        <div class="cl-thread-well">
            <div class="col-sm-2">
                Likes
            </div>
            <div class="col-sm-8">
                <a href="{{ route('thread.show', $thread) }}">{{ $thread->name }}</a>
            </div>
            <div class="col-sm-2">
                Bumped
            </div>
        </div>
    @endforeach
@endsection

@section('sidebar')
    @include('partials._chatfriends')
    @include('partials._donations')
@endsection