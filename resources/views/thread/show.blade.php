@extends('layouts.app')

@section('content')
    <h1>{{ $thread->name }}</h1>
    @foreach($posts as $post)
        {!! $post->html !!}
        @if($post->has('children'))
            @foreach($post->children as $child)
                {!! $child->html !!}
            @endforeach
        @else
            No children
        @endif
    @endforeach
    {{ $posts->links() }}
@endsection

