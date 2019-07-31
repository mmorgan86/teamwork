@extends('layouts.app')

@section('content')

    <div class="bg-grey-lighter font-sans flex">

        <div class="container mx-auto justify-center lg:w-3/5">
            
            <div class="card" style="padding: 4rem;">

                <h1 class="font-normal mb-6 text-center text-3xl">
                    Let's begin something new
                </h1>

                <form 
                    action="/projects" 
                    method="POST">
                
                    @include('projects._form', [
                        'project' => new App\Project,
                        'buttonText' => 'Create Project'
                        ])

                </form>
        </div>
    </div>
</div>

@endsection