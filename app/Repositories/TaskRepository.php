<?php

namespace App\Repositories;

use App\Http\Requests\Request;
use App\User;
use App\Task;
use Illuminate\Support\Facades\DB;

class TaskRepository
{
    /**
     * 返回当前用户的所有日报对象
     * @param User $user
     * @param $offset
     * @param $length
     * @param null $searchKeyWords 搜索关键词
     * @return mixed
     */
    public function forUser(User $user,$offset,$length,$searchKeyWords=null)
    {
        return Task::where([['user_id', $user->id],["reporter","LIKE",$searchKeyWords]])
                    ->orWhere([['user_id', $user->id],["department","LIKE",$searchKeyWords]])
                    ->orWhere([['user_id', $user->id],["date","LIKE",$searchKeyWords]])
                    ->orderBy('created_at', 'desc')
                    ->skip($offset)
                    ->take($length)
                    ->get();
    }

    /**
     * 返回当前用户日报数量
     * @param User $user
     * @param null $searchKeyWords
     * @return mixed
     */
    public function getcount(User $user,$searchKeyWords=null){
        return Task::where([['user_id', $user->id],["reporter","LIKE",$searchKeyWords]])
            ->orWhere([['user_id', $user->id],["department","LIKE",$searchKeyWords]])
            ->orWhere([['user_id', $user->id],["date","LIKE",$searchKeyWords]])
            ->orderBy('created_at', 'desc')
            ->count();
    }
    /**
     * 返回所有用户的所有日报对象
     * @param $offset
     * @param $length
     * @return mixed
     */
    public function adminUser($offset,$length)
    {
            return DB::table("tasks")
                ->orderBy('created_at', 'desc')
                ->skip($offset)
                ->take($length)
                ->get();
    }

    public function searchAllUser($offset,$length,$searchKeyWords){
        return DB::table("tasks")
            ->where("reporter","LIKE",$searchKeyWords)
            ->orWhere("department","LIKE",$searchKeyWords)
            ->orWhere("date","LIKE",$searchKeyWords)
            ->orderBy('created_at', 'desc')
            ->skip($offset)
            ->take($length)
            ->get();
    }

    /**
     * 返回所有用户日报数量
     * @return mixed
     */
    public function count(){
            return DB::table("tasks")
                ->count();
    }

    /**
     * 返回所有用户日报数量
     * @param null $searchKeyWords
     * @return mixed
     */
    public function searchAllCount($searchKeyWords){
            return DB::table("tasks")
                ->where("reporter","LIKE",$searchKeyWords)
                ->orWhere("department","LIKE",$searchKeyWords)
                ->orWhere("date","LIKE",$searchKeyWords)
                ->orderBy('created_at', 'desc')
                ->count();

    }

    /**
     * @param User $user
     * @param $date
     * @return mixed
     */
    public function show(User $user,$date){
        return Task::where([["date",$date], ["user_id",$user->id],])
                    ->get();
    }
    public function hasData(User $user,$date){
        return json_decode(json_encode(Task::where([["date",$date], ["user_id",$user->id],])->get()));
    }

}
