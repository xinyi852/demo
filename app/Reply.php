<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    //
    /**
     * @var array
     */
    protected $fillable = ['content','reviewer','reviewer_uid'];

    protected $casts = [
        'task_id' => 'int',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function task(){
        return $this->belongsTo(Task::class);
    }
}
