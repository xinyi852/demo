<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;
use App\Repositories\TaskRepository;

use Illuminate\Support\Facades\Date;


class TaskController extends Controller
{
    /**
     * The task repository instance.
     *
     * @var TaskRepository
     */
    protected $tasks;

    /**
     * Create a new controller instance.
     *
     * @param  TaskRepository  $tasks
     * @return void
     */
    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');

        $this->tasks = $tasks;
    }
    /**
     * Display a list of all of the user's task.
     */
    public function index()
    {
            return view('tasks.index');
    }
    public function show(Request $request,$date){

        return view('tasks.task_show',[
            "tasks"=>$this->tasks->show($request->user()->id,$date)
        ]);
    }

    /**
     * 我的日报信息源
     * @param Request $request
     */
    public function mytask(Request $request){
        $offset=$_REQUEST['start'];
        $length = $_REQUEST['length'];
        if ($length>50){
            $length = 50;
        }

        $searchResultCount = NULL;
        $searchKeyWords = "%".$_REQUEST['search']['value']."%";
        if($_REQUEST['search']['value']==""){
            $count =$this->tasks->getcount($request->user());
            $tasks =$this->tasks->forUser($request->user(),$offset,$length);

        }else{
            $searchResultCount =$this->tasks->getcount($request->user(),$searchKeyWords);
            $tasks =$this->tasks->forUser($request->user(),$offset,$length,$searchKeyWords);
        }

        echo json_encode([
            'draw'=>$_REQUEST['draw'],
            'recordsTotal'=>$searchResultCount===NULL?$count:$searchResultCount,
            'recordsFiltered'=>$searchResultCount===NULL?$count:$searchResultCount,
            'data'=>$tasks,
        ]);

        die();
    }
    public function edit(Request $request,$date){
        return view('tasks.task_edit',[
            "tasks"=>$this->tasks->show($request->user()->id,$date)
        ]);
    }



    /**
     * @param $task_id
     * @return Task
     */
    private function findTaskTest($task_id):Task
    {
        return Task::where("id",$task_id)->get();
    }

    /**
     * @param $task_id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function reply($task_id,Request $request){
        date_default_timezone_set('PRC');

        $task = $this->findTaskTest($task_id);
        $task[0]->replys()->create([
                'contents' => $request->contents,
                'reviewer' => $request->user()["name"],
                'reviewer_uid' => $request->user()["id"],
            ]);
        return redirect('/tasks');
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
                "status" => "review",
            ]);
        }

        return redirect('/tasks');
    }


    public function destroy(Request $request, Task $task)
    {
        $this->authorize('destroy', $task);

        $task->delete();

        return redirect('/tasks');
    }
}
