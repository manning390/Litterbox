@inject('flavor', 'App\Services\FlavorService')
@if(Auth::check())
    @if($user->announcements->first())
        <div class="well well-sm">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h1>{{ $user->announcements->first()->header }}</h1>
            <p>{{ $user->announcements->first()->body }}</p>
        </div>
    @endif
@else
    <div class="well text-right metal-bg">
        <h3>{{ $flavor->flave() }}</h3>
        <p>Join a laid-back, close-knit community of mixed interests <a href="{{ route('auth.register') }}" class="btn btn-danger">Get a free account!</a></p>
    </div>
@endif