<?php

namespace Tests\Feature;

use Tests\TestCase;
use Facades\Tests\Setup\ProjectFactory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Project;

class ProjectTasksTest extends TestCase
{
    use RefreshDatabase;

    /**
     *  test
     */
    public function test_guest_cannot_add_tasks_to_projects()
    {
        $project = factory('App\Project')->create();

        $this->post($project->path(). '/tasks')->assertRedirect('login');
    }

    /**
     *  test
     */
    public function test_only_the_owner_of_a_project_may_add_task()
    {
        // sign in user
        $this->signin();

        // create project not by the signed in user
        $project = factory('App\Project')->create();

        // add task to that project from the outside in
        $this->post($project->path().'/tasks', ['body' => 'Test Task'])
        ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'TestTask']);
    }

    /**
     *  test
     */
    public function test_only_the_owner_of_a_project_may_update_task()
    {

        // sign in user
        $this->signin();

        $project = ProjectFactory::withTasks(1)->create();

        // add task to that project from the outside in
        $this->patch($project->tasks[0]->path(), ['body' => 'changed'])
            ->assertStatus(403);

        // double check to make sure the record "changed" does not exist in db
        $this->assertDatabaseMissing('tasks', ['body' => 'changed']);
    }

    /**
     *  test
     */
    public function test_a_project_can_have_task()
    {

        $project = ProjectFactory::create();

        $this->actingAs($project->owner)
            ->post($project->path().'/tasks', ['body' => 'Test_Task']);

        $this->get($project->path())
            ->assertSee('Test_Task');
    }

    /**
     * test
     */
    public function test_a_task_can_be_updated()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $this->actingAs($project->owner)
            ->patch($project->tasks[0]->path(), ['body' => 'changed']);

        $this->assertDatabaseHas('tasks', [
            'body' => 'changed'
        ]);
    }

    public function test_a_task_can_be_completed()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $this->actingAs($project->owner)
            ->patch($project->tasks[0]->path(), [
            'body' => 'changed',
            'completed' => true
        ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'changed',
            'completed' => true
        ]);
    }

    public function test_a_task_can_be_marked_as_incomplete()
    {
        $project = ProjectFactory::withTasks(1)->create();

        $this->actingAs($project->owner)
            ->patch($project->tasks[0]->path(), [
            'body' => 'changed',
            'completed' => true
        ]);

        $this->patch($project->tasks[0]->path(), [
            'body' => 'incompleted_task',
            'completed' => false
        ]);

        $this->assertDatabaseHas('tasks', [
            'body' => 'incompleted_task',
            'completed' => false
        ]);
    }

    public function test_a_task_requires_a_body()
    {
        $project = ProjectFactory::create();

        $attributes = factory('App\Task')->raw(['body' => '']);

       $this->actingAs($project->owner)
            ->post($project->path(). '/tasks',$attributes)
            ->assertSessionHasErrors('body');
    }
}
