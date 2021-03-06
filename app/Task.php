<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['date','today_tasks','today_works','tomorrow_tasks','idea','department','reporter'];

    /**
     * @var array
     */
    protected $casts = [
        'user_id' => 'int',
    ];
    /**
     * 获得用户的所有任务
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 返回属于日报的回复
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replys()
    {
        return $this->hasMany(Reply::class);
    }
}
