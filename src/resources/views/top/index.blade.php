@extends('layouts.app')

@section('content_header')
<h1>トップ</h1>
@stop

@section('content')
    @if (Auth::check())
        <p>ログインしています。</p>
        <p>ログインユーザー名：{{ Auth::user()->name }}</p>
        <p>ログインユーザー年齢：{{ $user->age }}歳</p>
    @else
        <p>ログインしていません。</p>
    @endif
@stop