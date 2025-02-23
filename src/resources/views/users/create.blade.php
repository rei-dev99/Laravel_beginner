@extends('layouts.app')
@section('content_header')
    <h1>新規ユーザー登録</h3>
@stop

@section('content')
    <div class="container=fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-header">
                        <div class="card-tools">
                            <a class="btn btn-default" href="{{route('users.index')}}">戻る</a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                        <div class="callout callout-warning">
                            <h5>ユーザーの登録に失敗しました</h5>
                            @if ($errors->has('name'))
                            <p>{{ $errors->first('name') }}</p>
                            @endif
                            @if ($errors->has('age'))
                            <p>{{ $errors->first('age') }}</p>
                            @endif
                            @if ($errors->has('tel'))
                            <p>{{ $errors->first('tel') }}</p>
                            @endif
                            @if ($errors->has('address'))
                            <p>{{ $errors->first('address') }}</p>
                            @endif
                            @if ($errors->has('email'))
                            <p>{{ $errors->first('email') }}</p>
                            @endif
                            @if ($errors->has('password'))
                            <p>{{ $errors->first('password') }}</p>
                            @endif
                        </div>
                        @endif

                        <form action="{{route('users.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="user">ユーザー名</label>
                                <input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="らんてくん">
                            </div>
                            <div class="form-group">
                                <label for="body">年齢</label>
                                <input type="number" name="age" class="form-control" value="{{old('age')}}" placeholder="25">
                            </div>
                            <div class="form-group">
                                <label for="body">電話番号</label>
                                <input type="number" name="tel" class="form-control" value="{{old('tel')}}" placeholder="09012345678">
                            </div>
                            <div class="form-group">
                                <label for="body">住所</label>
                                <input type="text" name="address" class="form-control" value="{{old('address')}}" placeholder="東京都渋谷区5-1-5">
                            </div>
                            <div class="form-group">
                                <label for="body">メールアドレス</label>
                                <input type="email" name="email" class="form-control" value="{{old('email')}}" placeholder="runteq@example.com">
                            </div>
                            <div class="form-group">
                                <label for="body">パスワード</label>
                                <input type="text" name="password" class="form-control" value="{{old('password')}}" placeholder="password">
                            </div>
                            <input type="submit" value="登録" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
