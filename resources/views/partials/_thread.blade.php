<div class="well well-sm col-sm-12">
    <div class="col-sm-2">
        <buttton class="btn btn-primary btn-block" style="border-left-radius: 0; border-right-radius: 0;">
            @if(!$thread->liked)
                &#9650;
            @else
                &#9660;
            @endif
        </buttton>
    </div>
    <div class="col-sm-8">
        <h3><a href="{{ route('thread.show', $thread) }}">{{ $thread->name }}</a></h3>
        <small><a href="{{ route('user.show', $thread->user) }}">{{ $thread->user->name }}</a> &bull; {{ $thread->posts->count() }} posts</small>
    </div>
    <div class="col-sm-2">
        bump
    </div>
</div>