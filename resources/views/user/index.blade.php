@extends('layouts.app')
@section('script')
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.material.min.js"></script>
{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
<script>
    $(document).ready(function() {
        $('#tasks').DataTable( {
            columnDefs: [
                {
                    targets: [ 0, 1, 2 ],
                    className: 'mdl-data-table__cell--non-numeric'
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
        <div class="col-sm-offset-2 col-sm-8">
                <div class="modal fade" style="background-color: " id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">修改密码</h5>
                                <button type="button" style="margin: -29px 1px -2px 0;font-size: 40px;" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" >&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" style="margin:auto auto auto auto">
                                <!-- Display Validation Errors -->
                            @include('common.errors')

                            <!-- New Task Form -->
                                <form action="{{ url('user/change') }}" method="POST" class="form-horizontal">
                                {{ csrf_field() }}

                                <!-- Task Name -->
                                    <div class="form-group">
                                        <label for="psd" class="col-sm-3 control-label">修改密码</label>

                                        <div class="col-sm-6">
                                            <label>输入您当前的密码：</label>
                                            <input type="password" name="old_password" id="old_password" class="form-control" value="">
                                            <label>需要修改的密码：</label>
                                            <input type="password" name="password" id="new_password" class="form-control" value="">
                                            <label>再次输入该密码：</label>
                                            <input type="password" name="check_password" id="check_password" class="form-control" value="">
                                        </div>
                                    </div>

                                    <!-- Add Task Button -->
                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-6">
                                            <button type="submit" class="btn btn-default">
                                                确认修改
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
                    <div class="panel-heading">
                        用户信息
                    </div>
                    <div class="panel-body">
                        {{$message}}
                        <table id="user" class="table table-striped task-table">
                            <thead>
                                <th>姓名</th>
                                <th>部门</th>
                                <th>邮箱</th>
                                <th>选项</th>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td class="table-text"><div>{{ $user->name }}</div></td>
                                        <td class="table-text"><div>{{ $user->department }}</div></td>
                                        <td class="table-text"><div>{{ $user->email }}</div></td>
                                        <td>
                                            <div class="row" style="padding: 0 20px;height: 40px;margin-left: 10px">
                                                <button type="button" style="margin-right: 5px;height: 30px;line-height: 28px;
            padding: 0px 20px; border-radius: 0px;" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                                                    修改密码
                                                </button>

                                            </div>
                                        </td>

                                    </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
    </div>
@endsection
