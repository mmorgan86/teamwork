<?php

namespace Tests\Feature;

use App\Project;
use App\Task;
use Facades\Tests\Setup\ProjectFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;
    /** @test */
    function guests_cannot_manage_projects()
    {
        $project = factory('App\Project')->create();
        $this->get('/projects')->assertRedirect('login');
        $this->get('/projects/create')->assertRedirect('login');
        $this->get($project->path().'/edit')->assertRedirect('login');
        $this->get($project->path())->assertRedirect('login');
        $this->post('/projects', $project->toArray())->assertRedirect('login');
    }
    /** @test */
    function a_user_can_create_a_project()
    {
        $this->withoutExceptionHandling();
        $this->signin();
        $this->get('/projects/create')->assertStatus(200);
        $this->followingRedirects()
            ->post('/projects', $attributes = factory(Project::class)->raw())
            ->assertSee($attributes['title'])
            ->assertSee($attributes['description'])
            ->assertSee($attributes['notes']);
    }

    /**
     * test
     */
    function tasks_can_be_included_as_part_of_a_new_project_creation()
    {
        $this->signin();

        $attributes = factory(Project::class)->raw();

        $attributes['tasks'] = [
            ['body' => 'Task 1'],
            ['body' => 'Task 2'],
        ];

        $this->post('/projects/'. $attributes);

        $this->assertCount(2, Project::first()->tasks);

    }


    /** @test */
    function tasks_can_be_included_as_part_a_new_project_creation()
    {
        $this->signIn();
        $attributes = factory(Project::class)->raw();
        $attributes['tasks'] = [
            ['body' => 'Task 1'],
            ['body' => 'Task 2']
        ];
        $this->post('/projects', $attributes);
        $this->assertCount(2, Project::first()->tasks);
    }
    /** @test */
    function a_user_can_see_all_projects_they_have_been_invited_to_on_their_dashboard()
    {
        $project = tap(ProjectFactory::create())->invite($this->signin());
        $this->get('/projects')->assertSee($project->title);
    }
    /** @test */
    function unauthorized_users_cannot_delete_projects()
    {
        $project = ProjectFactory::create();
        $this->delete($project->path())
            ->assertRedirect('/login');

        $user = $this->signin();
        $this->delete($project->path())->assertStatus(403);

        $project->invite($user);
        $this->actingAs($user)->delete($project->path())->assertStatus(403);
    }
    /** @test */
    function a_user_can_delete_a_project()
    {
        $project = ProjectFactory::create();
        $this->actingAs($project->owner)
            ->delete($project->path())
            ->assertRedirect('/projects');
        $this->assertDatabaseMissing('projects', $project->only('id'));
    }
    /** @test */
    function a_user_can_update_a_project()
    {
        $project = ProjectFactory::create();
        $this->actingAs($project->owner)
            ->patch($project->path(), $attributes = ['title' => 'Changed', 'description' => 'Changed', 'notes' => 'Changed'])
            ->assertRedirect($project->path());
        $this->get($project->path().'/edit')->assertOk();
        $this->assertDatabaseHas('projects', $attributes);
    }
    /** @test */
    function a_user_can_update_a_projects_general_notes()
    {
        $project = ProjectFactory::create();
        $this->actingAs($project->owner)
            ->patch($project->path(), $attributes = ['notes' => 'Changed']);
        $this->assertDatabaseHas('projects', $attributes);
    }
    /** @test */
    function a_user_can_view_their_project()
    {
        $project = ProjectFactory::create();
        $this->actingAs($project->owner)
            ->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->description);
    }
    /** @test */
    function an_authenticated_user_cannot_view_the_projects_of_others()
    {
        $this->signin();
        $project = factory('App\Project')->create();
        $this->get($project->path())->assertStatus(403);
    }
    /** @test */
    function an_authenticated_user_cannot_update_the_projects_of_others()
    {
        $this->signin();
        $project = factory('App\Project')->create();
        $this->patch($project->path())->assertStatus(403);
    }
    /** @test */
    function a_project_requires_a_title()
    {
        $this->signin();
        $attributes = factory('App\Project')->raw(['title' => '']);
        $this->post('/projects', $attributes)->assertSessionHasErrors('title');
    }
    /** @test */
    function a_project_requires_a_description()
    {
        $this->signin();
        $attributes = factory('App\Project')->raw(['description' => '']);
        $this->post('/projects', $attributes)->assertSessionHasErrors('description');
    }
}
