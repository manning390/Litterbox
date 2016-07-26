@extends('layouts.app')

@section('content')
    @foreach($flags as $status => $group)
        <table class="table table-responsive">
            <caption>{{ $statuses[$status] }}</caption>
            <thead>
                <tr>
                    <td>#</td>
                    <td>User</td>
                    <td>Type</td>
                    <td>Reason</td>
                    <td>Handle</td>
                </tr>
            </thead>
            <tbody>
                @foreach($group as $flag)
                    <tr>
                        <td>{{ $flag->id }}</td>
                        <td>
                            <a href="{{ route('user.show', $flag->user->name) }}">{{ $flag->user->name }}</a>
                        </td>
                        <td>{{ $types[$flag->type] }}</td>
                        <td>{{ $flag->body }}</td>
                        <td>
                            <a href="{{ route('thread.show', $flag->post->thread) }}">
                                <i class="glyphicon glyphicon-modal-window"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
@endsection