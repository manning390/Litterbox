@extends('layouts.app')

@section('content')
    <h1>Admin Index</h1>
    <ul>
        <li><a href="{{ route('admin.announce') }} }">Annoucements</a></li>
        <li><a href="#">Chat Moderation</a> <small>Chat Bans, Chat Mutes, etc.</small></li>
        <li><a href="#">Website Moderation</a> <small>Forum Bans, Website Bans, etc.</small></li>
        <li><a href="{{ route('admin.badge.index') }}">Badge Moderation</a></li>
        <li><a href="#">Manage Flags</a></li>
        <li><a href="#">Manage Threads / Posts</a></li>
        <li><a href="#">Manage Users</a> <small>Profiles, Avatars, Badges</small></li>
        <li><a href="#">Permissions</a></li>
    </ul>
@endsection