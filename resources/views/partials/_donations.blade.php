@inject('donations', 'App\Services\DonationsService')

<div id="chatfriends" class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Donations</h3>
    </div>
    <div class="panel-body">
        <div class="progress">
            <div class="progress-bar progress-bar-danger"
                role="progressbar"
                aria-valuenow="{{ $donations->percent() }}"
                aria-valuemin="0"
                aria-valuemax="100"
                style="width: {{ $donations->percent() }}%"
            >
                    {{ $donations->percent() }}% &dash; ${{ $donations->current() }}/${{ $donations->monthly() }} this month (+${{ $donations->rolling() }})
            </div>
        </div>

        <a href="#" class="btn btn-danger btn-block">Donate with PayPal</a>
        <a href="#" class="btn btn-danger btn-block">Donate with Patreon</a>
    </div>
</div>
