<div class="thread-well col-sm-12">
    <div class="likes col-sm-2">
        <div class="input-group">
            <span class="input-group-btn">
                <button class="btn btn-primary">
                    @if(!$thread->liked)
                        &#9650;
                    @else
                        &#9660;
                    @endif
                </button>
            </span>
            <p class="form-control-static text-center">{{ $thread->likes }}</p>
        </div>
    </div>
    <div class="content col-sm-8">
        <h3><a href="{{ route('thread.show', $thread) }}">{{ $thread->name }}</a></h3>
        <small><a href="{{ route('user.show', $thread->user) }}">{{ $thread->user->name }}</a> &bull; {{ $thread->posts->count() }} posts</small>
    </div>
    <div class="bump col-sm-2">
        {{ $thread->bump->created_at->diffForHumans() }}<br />
        {{ $thread->bump->user->name }}
    </div>
</div>