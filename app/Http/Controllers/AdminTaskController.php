<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use App\Task;
use App\Repositories\TaskRepository;
use Illuminate\Support\Facades\Date;

class AdminTaskController extends Controller
{

    protected $tasks;

    /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('admin');

        $this->tasks = $tasks;
    }

    /**
     * Display a list of all of the user's task.
     */
    public function index()
    {
            return view('admin.index');

    }
    /**
     * 所有日报信息源
     */
    public function adminTask(){
        $offset=$_REQUEST['start'];
        $length = $_REQUEST['length'];
        if ($length>50){
            $length = 50;
        }
        $searchResultCount = NULL;
        $searchKeyWords = "%".$_REQUEST['search']['value']."%";
        if($_REQUEST['search']['value']==""){
            $count =$this->tasks->count();
            $tasks =$this->tasks->adminUser($offset,$length);

        }else{
            $searchResultCount =$this->tasks->searchAllCount($searchKeyWords);
            $tasks =$this->tasks->searchAllUser($offset,$length,$searchKeyWords);
        }

        echo json_encode([
            'draw'=>$_REQUEST['draw'],
            'recordsTotal'=>$searchResultCount===NULL?$count:$searchResultCount,
            'recordsFiltered'=>$searchResultCount===NULL?$count:$searchResultCount,
            'data'=>$tasks,
        ]);

        die();
    }

    /**
     * 审批日报详情页
     * @param $task_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function review($task_id){
        $task =  Task::where('id',$task_id)->get();
        Task::where('id',$task_id)
            ->update(
                ['status'=>'reviewed']
            );
        return view('admin.task_show', [
            'tasks' =>  $task,
        ]);
    }

    public function reply(Request $request){
        $task_id = $_REQUEST["task_id"];
        Task::where('id',$task_id)
            ->update(
                ['reply'=>$request->user()["name"]."回复：".$_REQUEST["reply"]]
            );
        return redirect('/admin/task/'.$task_id);
    }


    /**
     * Create a new task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
//        $this->validate($request, [
//            'name' => 'required|max:255',
//        ]);
        date_default_timezone_set('PRC');
        if([]==$this->tasks->hasData($request->user(),date("Y-m-d")))
        {
            $request->user()->tasks()->create([
                'date' =>date("Y-m-d"),
                'today_tasks' => $request->today_tasks,
                'today_works' => $request->today_works,
                'tomorrow_tasks' => $request->tomorrow_tasks,
                'idea' => $request->idea,
                'department' => $request->user()["department"],
                'reporter' => $request->user()["name"],
            ]);
        }

        return redirect('/tasks');
    }

    /**
     * Destroy the given task.
     *
     * @param  Request  $request
     * @param  Task  $task
     * @return Response
     */
    public function destroy(Request $request, Task $task)
    {
        $this->authorize('destroy', $task);

        $task->delete();

        return redirect('/tasks');
    }
}
