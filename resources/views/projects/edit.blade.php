@extends('layouts.app')

@section('content')

    <div class="bg-grey-lighter font-sans flex">

        <div class="container mx-auto justify-center lg:w-3/5">
            
            <div class="card" style="padding: 4rem;">

                <h1 class="font-normal mb-6 text-center text-3xl">
                    Edit Project
                </h1>

                <form 
                    action="{{ $project->path() }}" 
                    method="POST">
                
                    @include('projects._form',[
                        'buttonText' => 'Update Project'
                    ])
                    @method('PATCH')

                </form>
        </div>
    </div>
</div>

@endsection