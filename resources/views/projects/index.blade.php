@extends('layouts.app')

@section('content')
    
    <header class="flex items-center mb-3">
        <div class="flex justify-between items-center w-full">
            <h2 class='text-grey text-sm font-normal'>My Projects</h2>
            <a href="/projects/create" class='button'>New Project</a>
        </div>
    </header>


    <main class="flex flex-wrap -mx-3 py-4">
        @forelse($projects as $project)
            <div class="px-3 pb-6" style="width:31.33%;">
                <div class="bg-white rounded shadow p-5" style="height: 200px;">
                    <h3 class="font-normal text-xl py-4  -ml-5 border-l-4 border-blue pl-4">{{ $project->title }}</h3>

                    <div class="text-grey">{{ str_limit($project->description, 100) }}</div>
                </div>

            </div>

        @empty  
            <div>No projects yet.</div>
        @endforelse
    </main>

@endsection