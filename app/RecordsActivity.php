<?php

namespace App;

trait RecordsActivity
{
    
    /**
     * The porjects old attributes
     * 
     *  @array
     */    
    public $oldAttributes = [];

    /**
     * Boot the trait
     */
    public static function bootRecordsActivity()
    {
        foreach(self::recordableEvents() as $event) {
            static::$event(function($model) use ($event) {
                $model->recordActivity($model->activityDescription($event)); // Ex: created_task
            });

            
            if ($event === 'updated') {
                static::updating(function ($model){
                    $model->oldAttributes = $model->getOriginal();
                });
            }
        }
    }

    /**
     * Get the description of the activity.
     */
    public function activityDescription($description)
    {
        return "{$description}_".strtolower(class_basename($this)); 
    }

    public function recordActivity($description)
    {
        $this->activity()->create([
            'description' => $description,
            'changes' => $this->activityChanges(),
            'project_id' => class_basename($this) === 'Project' ? $this->id : $this->project->id
        ]); 
    }
    

    /** 
     * Return an array
     */
    public static function recordableEvents()
    {
        if(isset(static::$recordableEvents)) {
            return static::$recordableEvents; 

        }
        
        return ['created', 'updated', 'deleted'];
    }
       
    /**
     * The activity feed for the project
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function activity()
    {
        return $this->morphMany(Activity::class, 'subject')->latest();
    }

     /**
     * gets activity changes
     */
    public function activityChanges()
    {
        if($this->wasChanged()){
            return [
                'before' => array_except(array_diff($this->oldAttributes, $this->getAttributes()), 'updated_at'),
                'after' => array_except($this->getChanges(), 'updated_at')
            ];
        }
    }
}