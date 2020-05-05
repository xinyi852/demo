@extends('layouts.app')
@section('script')
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.material.min.js"></script>
{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
<script>
    $(document).ready(function() {
        $('#tasks').DataTable( {
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "tasks/all",
            },
            "columns": [
                { "data": null,
                    render:function (row, meta, index) {
                        return'<div><a href="task/'+row.id+'">'+row.date+'</a> </div>'
                    }
                },
                { "data": "department" },
                { "data": "reporter" },
                { "data": null,
                    render:function (row,meta,index) {
                        if ("reviewed" !== row.status) {
                            return "<div class=\"ext-status\"><span class=\"tc-icon-text\">\n" +
                                "                        <span style='color: red'>未审批</span>\n" +
                                "                        <i class=\"czs-about-l\" ></i>\n" +
                                "                    </span>" ;
                        } else {
                            return "<span class=\"tc-icon-text\">\n" +
                                "                        <span  style='color: green'>已审批</span >\n" +
                                "                    </span>";
                        }
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

        </div>
        <div class="col-sm-offset-2 col-sm-8">

            <!-- Current Tasks -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>审批所有工作日报</h4>
                    </div>

                    <div class="panel-body">
                        <table id="tasks" class="table table-striped task-table">
                            <thead>
                            <tr>
                                <th>任务日期</th>
                                <th>部门</th>
                                <th>汇报人</th>
                                <th>状态</th>
                                <th>&nbsp;</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>任务日期</th>
                                <th>部门</th>
                                <th>汇报人</th>
                                <th>状态</th>
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
