@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <h5>添加日报</h5>

            <form action="{{ url('task') }}" style="width: 500px" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <!-- Task Name -->
                <div class="form-group">
                    <div class="col-sm-12">
                        <label>今日工作安排：</label>
                        <textarea name="today_tasks" style="width: 800px;height: 120px" id="today_tasks" class="form-control" value="{{ old('task') }}"></textarea>
                        <label>今日工作内容：</label>
                        <textarea  name="today_works" style="width: 800px;height: 120px" id="today_works" class="form-control" value="{{ old('task') }}"></textarea>
                        <label>总结或建议：</label>
                        <textarea name="idea" style="width: 800px;height: 120px" id="idea" class="form-control" value="{{ old('task') }}"></textarea>
                        <label>明日工作安排：</label>
                        <textarea  name="tomorrow_tasks" style="width: 800px;height: 120px" id="tomorrow_tasks" class="form-control" value="{{ old('task') }}"></textarea>
                    </div>
                </div>

                <!-- Add Task Button -->
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-12">
                        <button type="submit" class="btn btn-default">
                            <i class="fa fa-btn fa-plus"></i>提交日报
                        </button>
                    </div>
                </div>
            </form>
        </div>


        </div>
    </div>
@endsection
