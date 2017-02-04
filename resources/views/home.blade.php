@extends('layouts.app')

@section('content')
    @if($pinned->count() > 0)
        <div class="well tri-bg clearfix">
            @each('partials._thread', $pinned, 'thread')
        </div>
    @endif
    <div class="well tri-bg clearfix">
        <a href="{{ route('thread.create') }}" class="btn btn-primary btn-block">Make a New Thread</a>
        <ul class="nav nav-pills">
            <li role="presentation" class="active"><a href="#" class="uppercase">Bumped</a></li>
            <li role="presentation"><a href="#" class="uppercase">Popular</a></li>
            <li role="presentation"><a href="#" class="uppercase">New</a></li>
            <li role="presentation" class="pull-right"><a href="#" class="uppercase">Notices</a></li>
        </ul>
        @each('partials._thread', $bumped, 'thread')
    </div>
@endsection

@section('sidebar')
    @include('partials._chatfriends')
    @include('partials._donations')
@endsection