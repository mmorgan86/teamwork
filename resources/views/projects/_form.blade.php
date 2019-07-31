
@csrf

<div class="mb-6 pr-6">
    <label for="title" class="font-bold text-grey-darker block mb-2 text-lg">Title</label>
    <input 
        type="text" 
        name="title" 
        class="block appearance-none w-full bg-white border border-grey-light hover:border-grey px-2 py-2 rounded shadow text-lg"
        value="{{ $project->title }}"
        required
    >
</div>
<div class="mb-6 pr-6">
    <label for="description" class="font-bold text-grey-darker block mb-2 text-lg">Description</label>
    <textarea 
        name="description" 
        id="description" 
        class="block appearance-none w-full bg-white border border-grey-light hover:border-grey px-2 py-2 rounded shadow text-lg"
        required
    >{{$project->description}}
    </textarea>
</div>
<div class="flex justify-between">
    <button class="button bg-blue hover:bg-blue-light text-lg">
        {{ $buttonText }}
    </button>
    <a href="{{$project->path()}}" class="button bg-red hover:bg-red-light text-lg">
        Cancel
    </a>
</div>

@if($errors->any())
    <div class="field mt-6">
        @foreach($errors->all() as $error)
            <li class="text-sm text-red">{{ $error }}</li>
        @endforeach
    </div>
@endif

            