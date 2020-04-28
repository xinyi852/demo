@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">

            <!-- Current Task -->
            @foreach ($tasks as $task)

                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ $task->date }}工作日报
                    </div>

                    <div class="panel-body">
                        <div>
                            日期：{{ $task->date }} <br/>
                            汇报人：{{$task->reporter}}<br/>
                            部门：{{$task->department}}<br/>
                        </div>
                        <div>
                            工作计划：<br/>
                            {{$task->today_tasks}}
                        </div>
                        <div>
                            工作总结：<br/>
                            {{$task->today_works}}
                        </div>
                        <div>
                            次日计划：<br/>
                            {{$task->tomorrow_tasks}}
                        </div>
                        <div>
                            建议及想法：<br/>
                            {{$task->idea}}
                        </div>
                        <div>
                            创建于：{{$task->created_at}}<br/>
                            更新于：{{$task->updated_at}}
                        </div>
                    </div>
                </div>
                @endforeach


        </div>
    </div>
@endsection
