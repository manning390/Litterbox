@if(Auth::check())
    @if($user->announcements->first())
        <div class="well well-sm">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h1>{{ $user->announcements->first()->header }}</h1>
            <p>{{ $user->announcements->first()->body }}</p>
        </div>
    @endif
@else
    <div class="well">
        Join the colorless today~
    </div>
@endif