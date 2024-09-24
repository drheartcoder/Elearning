@extends('errors::layout')

@section('title', 'Page Expired')

@section('message')
    The page has expired due to inactivity.
    <br/><br/>
    Please refresh and try again.
    <a href="{{url('/')}}"><button>Go To Home</button></a>
@stop
