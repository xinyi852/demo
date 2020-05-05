@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">

            <!-- Current Task -->
            @foreach ($tasks as $task)

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5>{{$task->department}}-{{$task->reporter}}:{{ $task->date }}工作日报@if ($task->status=="reviewed")
                                <span style="color: green">(已审核过)</span>
                            @else
                                <span style="color: red">(未审核过)</span>
                            @endif</h5>

                    </div>

                    <div class="panel-body" style="padding: 20px">
                        <div style="padding: 10px">
                            日期：{{ $task->date }} <br/>
                            汇报人：{{$task->reporter}}<br/>
                            部门：{{$task->department}}<br/>
                        </div>
                        <div>
                            工作计划：
                            <p>{{$task->today_tasks}}</p>
                        </div>
                        <div>
                            工作总结：
                            <p>{{$task->today_works}}</p>
                        </div>
                        <div>
                            次日计划：
                            <p>{{$task->tomorrow_tasks}}</p>
                        </div>
                        <div>
                            建议及想法：
                            <p>{{$task->idea}}</p>
                        </div>
                        <div style="padding: 10px">
                            创建于：{{$task->created_at}}<br/>
                            更新于：{{$task->updated_at}}
                        </div>
                        <div>
                            {{$task->reply}}
                            <div class="row" style="padding: 20px;height: 40px;">
                                <button type="button"  class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                                    回复
                                </button>

                            </div>
                            <div class="col-sm-offset-2 col-sm-12">
                                <div class="modal fade" style="background-color: " id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalCenterTitle">回复工作日报</h5>
                                                <button type="button" style="margin: -29px 1px -2px 0;font-size: 40px;" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true" >&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body" style="margin:auto auto auto auto">
                                                <!-- Display Validation Errors -->
                                            @include('common.errors')

                                            <!-- New Task Form -->
                                                <form action="{{ url('admin/task/reply') }}" style="width: 500px" method="POST" class="form-horizontal">
                                                {{ csrf_field() }}

                                                <!-- Task Name -->
                                                    <div class="form-group">
                                                        <div class="col-sm-12">
                                                            <input hidden name="task_id" value="{{$task->id}}">
                                                            <label>回复：</label>
                                                            <textarea  name="reply" style="width: 450px;height: 120px" id="reply" class="form-control" ></textarea>
                                                        </div>
                                                    </div>

                                                    <!-- Add Task Button -->
                                                    <div class="form-group">
                                                        <div class="col-sm-offset-3 col-sm-12">
                                                            <button type="submit" class="btn btn-default">
                                                                <i class="fa fa-btn fa-plus"></i>回复
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">关闭</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                @endforeach


        </div>
    </div>
@endsection
