@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">

            <!-- Current Task -->
            @foreach ($tasks as $task)

                <div class="panel panel-default">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/tasks') }}">主页</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ url('/tasks') }}">我的日报</a>
                        </li>
                        <li class="breadcrumb-item">
                            {{ $task->date }}
                        </li>
                    </ul>
                    <div class="panel-heading" style="padding: 20px">
                        <h4>{{ $task->date }}工作日报<i ></i><a href="{{url("/task/edit/{$task->date}")}}" style="padding: 20px">修改</a></h4>
                    </div>

                    <div class="panel-body" >
                        <div style="padding: 20px">
                            日期：{{ $task->date }} <br/>
                            汇报人：{{$task->reporter}}<br/>
                            部门：{{$task->department}}<br/>
                        </div>
                        <div style="padding: 20px">
                            工作计划：<br/>
                            {{$task->today_tasks}}
                        </div>
                        <div style="padding: 20px">
                            工作总结：<br/>
                            {{$task->today_works}}
                        </div>
                        <div style="padding: 20px">
                            次日计划：<br/>
                            {{$task->tomorrow_tasks}}
                        </div>
                        <div style="padding: 20px">
                            建议及想法：<br/>
                            {{$task->idea}}
                        </div>
                        <div style="padding: 20px">
                            创建于：{{$task->created_at}}<br/>
                            更新于：{{$task->updated_at}}
                        </div>
                    </div>
                </div>
                @endforeach


        </div>
    </div>
@endsection
