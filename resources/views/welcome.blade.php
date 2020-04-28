@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">欢迎！</div>

                <div class="panel-body">
                    您目前访问的是测试版本1.0
                </div>
                <a href="{{url("/login")}}" >去登陆</a>
            </div>
        </div>
    </div>
</div>
@endsection
