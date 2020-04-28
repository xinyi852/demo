@extends('layouts.app')
@section('script')
{{--<script src="https://code.jquery.com/jquery-3.3.1.js"></script>--}}
{{--<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>--}}
{{--<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">--}}

{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
<script>
    $(document).ready(function() {
        $('#tasks').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "/tasks/my",
            },
            "columns": [
                { "data": null,
                    render:function (row, meta, index) {
                        return'<div><a href="/task/'+row.date+'">'+row.date+'</a> </div>'
                    }
                },
                { "data": "department" },
                { "data": "reporter" },
                { "data": null,
                    render:function (row, meta, index) {
                        return'<div><input style="margin: auto auto auto auto" type="checkbox" class="tc-15-checkbox"></div>'
                    }
                },
                { "data": null,
                    render:function (row, meta, index) {
                        return'<div><input style="margin: auto auto auto auto" type="checkbox" class="tc-15-checkbox"></div>'
                    }
                }
            ],
            "language": {
                "lengthMenu": "每页最多展示 _MENU_ 条日报",
                "zeroRecords": "没有数据",
                "info": "第 _PAGE_ 页 共 _PAGES_ 页 _MAX_ 条日报",
                "infoEmpty": "没有找到该日报",
                "infoFiltered": "(共 _MAX_ 条日报记录)",
                "search":         "搜索:",
                "paginate": {
                    "first":      "首页",
                    "last":       "末页",
                    "next":       "下一页",
                    "previous":   "上一页"
                },
                "processing": "正在加载中",
            }
        } );
        $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        });
    } );
</script>
@endsection


@section('content')
    <div>

    <div class="container">
        <div class="row" style="padding: 0 20px;height: 40px;margin-left: 10px">
            <button type="button"  class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                添加日报
            </button>

        </div>
        <div class="col-sm-offset-2 col-sm-12">
                <div class="modal fade" style="background-color: " id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">提交今天的工作日报</h5>
                                <button type="button" style="margin: -29px 1px -2px 0;font-size: 40px;" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" >&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" style="margin:auto auto auto auto">
                                <!-- Display Validation Errors -->
                            @include('common.errors')

                            <!-- New Task Form -->
                                <form action="{{ url('task') }}" style="width: 500px" method="POST" class="form-horizontal">
                                {{ csrf_field() }}

                                <!-- Task Name -->
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label>今日工作安排：</label>
                                            <textarea name="today_tasks" style="width: 450px;height: 120px" id="today_tasks" class="form-control" value="{{ old('task') }}"></textarea>
                                            <label>今日工作内容：</label>
                                            <textarea  name="today_works" style="width: 450px;height: 120px" id="today_works" class="form-control" value="{{ old('task') }}"></textarea>
                                            <label>总结或建议：</label>
                                            <textarea name="idea" style="width: 450px;height: 120px" id="idea" class="form-control" value="{{ old('task') }}"></textarea>
                                            <label>明日工作安排：</label>
                                            <textarea  name="tomorrow_tasks" style="width: 450px;height: 120px" id="tomorrow_tasks" class="form-control" value="{{ old('task') }}"></textarea>
                                        </div>
                                    </div>

                                    <!-- Add Task Button -->
                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-12">
                                            <button type="submit" class="btn btn-default">
                                                <i class="fa fa-btn fa-plus"></i>提交计划
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                            </div>
                        </div>
                    </div>
                </div>


            <!-- Current Tasks -->
                <div class="panel panel-default">
                    <div class="panel-heading" style="padding: 20px;border:1px">
                        <h4>我的工作日报</h4>
                    </div>

                    <div class="panel-body">
                        <table id="tasks" class="table table-striped">
                            <thead>
                            <tr>
                                <th>任务日期</th>
                                <th>部门</th>
                                <th>汇报人</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>任务日期</th>
                                <th>部门</th>
                                <th>汇报人</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
        </div>
    </div>
    </div>
@endsection
