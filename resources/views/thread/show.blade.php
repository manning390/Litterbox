@extends('layouts.app')

@section('content')
    <h1>{{ $thread->name }}</h1>
    @foreach($posts as $post)
        <article>
            <div class="post-author">
                <a href="{{ route('user.profile', $post->user) }}">
                    <img class="img-rounded thumbnail img-responsive" src="//placehold.it/50" alt="{{ $post->user->name }} avatar"/>
                </a>
            </div>
            <div class="post-links">
                <a href="{{ $post->permalink }}">#{{ $this->id }}</a>
                &mdot;
                <a href="#" data-toggle="tooltip" title="{{ $post->created_at }}" data-placement="top">{{ $post->created_at->diffForHumans() }}</a>
                &mdot;
                <a href="{{ route('user.profile', $post->user) }}">{{ $post->user->name }}</a> said:
            </div>
            {!! $post->html !!}
            @if($post->has('children'))
                @foreach($post->children as $child)
                    {!! $child->html !!}
                @endforeach
            @endif
        </article>
    @endforeach
    {{ $posts->links() }}
@endsection

@section('sidebar')
    @include('partials._chatfriends')
    @include('partials._donations')
@endsection
