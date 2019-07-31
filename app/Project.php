<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];

    /**
     * Returns project path
     */
    public function path ()
    {
        return "/projects/{$this->id}";
    }

    /**
     *  Returns project owner
     */
    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    /**
     *  Project has many relationship to a task
     */

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    /**
     *  Add task to a project
     * 
     * @param $body
     */

    public function addTask($body)
    {
        return $this->tasks()->create(compact('body'));
    }

    /**
     * The activity feed for the project
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function activity()
    {
        return $this->hasMany(Activity::class)->latest();
    }

    /**
     * Record activity for project
     * 
     * @param string $description
     */

    public function recordActivity($description)
    {
        $this->activity()->create(compact('description')); 
    }
}
