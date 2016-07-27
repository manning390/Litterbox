@extends('layouts.app')

@foreach($tags as $tag)
    {{ $tag->label }}<br />
@endforeach