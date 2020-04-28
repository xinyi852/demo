<?php

namespace App\Http\Controllers;

use App\User;
use Faker\Provider\DateTime;
use Illuminate\Database\DatabaseManager;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Task;
use App\Repositories\TaskRepository;
use Illuminate\Queue\Capsule\Manager;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    /**
     * Display a list of all of the user's task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        $message = null;
        return view('user.index', [
            'user' => $request->user(),
            "message"=>$message,
        ]);

    }

    public function change(Request $request){
        if ($_REQUEST["password"]==$_REQUEST["check_password"]){
            $user = $request->user();
            $opd = $_REQUEST["old_password"];
            $npd = $_REQUEST["password"];
            var_dump((bcrypt($opd)."<br/>".$user->password));
            die();

            if (bcrypt($opd) ==$user->password){
                $user->password = bcrypt($npd);
                $user->save();
                $message = "修改成功，请退出重新登录。";

                return view('user.index', [
                    'user' => $request->user(),
                    'message'=>$message,
                ]);
            }
            $message = "密码错误。";
            return view('user.index', [
                'user' => $request->user(),
                'message'=>$message,
            ]);
        }
        $message = "两次输入的密码不一样。";
        return view('user.index', [
            'user' => $request->user(),
            'message'=>$message,
        ]);

    }

}
