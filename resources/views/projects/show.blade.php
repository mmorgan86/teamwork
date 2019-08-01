@extends('layouts.app')

@section('content')

    <header class="flex items-center mb-3">
        <div class="flex justify-between items-end w-full">
            <p class="text-grey text-sm font-normal">
              <a href="/projects" class="text-grey text-sm font-normal no-underline">My Projects</a> / {{ $project->title }}
            </p>
        <a href="{{$project->path().'/edit'}}" class='button bg-blue'>Edit Project</a>
        </div>
    </header>

    <main>
        <div class="lg:flex -mx-3">
            <div class="lg:w-3/4 px-3 mb-6">
                <div class="mb-8">
                    <h2 class="text-lg text-grey font-normal mb-3">Task</h2>
                    <!-- tasks -->
                    @foreach($project->tasks as $task) 
                        
                        <div class="card mb-3">
                            <form action="{{ $task->path() }}" method="POST">
                                @method('PATCH')
                                @csrf
                                <div class="flex">
                                    <input name="body" value="{{ $task->body }}" class="border-none w-full {{ $task->completed ? 'text-grey line-through' : '' }}">
                                    <input type="checkbox" 
                                    name="completed" 
                                    style="transform:scale(1.5);" 
                                    onChange="this.form.submit()"
                                    {{ $task->completed ? 'checked' : ''}}
                                    >
                                </div>
                            </form>
                        </div>
                        
                    @endforeach
                    <div class="card mb-3">
                            <form action="{{ $project->path().'/tasks' }}", method="POST">
                                @csrf
                                <input placeholder="Add a new tasks..." class="w-full" name="body">
                            </form>
                            
                        </div>
                    </div>

                <div>
                    <h2 class="text-lg text-grey font-normal mb-3">General Notes</h2>


                    <!-- general notes -->
                    <form action="{{ $project->path() }}" method="POST">
                        @csrf   
                        @method('PATCH')
                        <div class="textwrapper">
                            <textarea 
                                name="notes"
                                class="border-none card w-full mb-4" 
                                style="min-height: 200px;"
                                placeholder="Anything special that you want to make note of?"
                                >{{ $project->notes }}</textarea>
                        </div>
                        <button type="submit" class="button bg-blue">Save</button>
                    </form>
                    @if($errors->any())
                        <div class="field mt-6">
                            @foreach($errors->all() as $error)
                                <li class="text-sm text-red">{{ $error }}</li>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            {{-- sideabar --}}
            <div class="lg:w-1/4 px-3" style="margin-top: 46px;">
                @include('projects.card')

                @include('projects.activity.card')
                
            </div>
        </div>
    </main>
@endsection