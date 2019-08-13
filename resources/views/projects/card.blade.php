
<div class="card flex flex-col">
    <h3 class="font-normal text-xl py-4 -ml-5 mb-3 border-l-4 border-accent-light pl-4">
        <a href="{{ $project->path() }}"
           class="text-default text-decoration-none font-bold no-underline"
        >
            {{ $project->title }}
        </a>
    </h3>

    <div class="text-default mb-4 flex-1">{{ str_limit($project->description, 100) }}</div>

    @can('manage', $project)
        <footer>
            <form method="POST" action="{{ $project->path() }}" class="text-right">
                @method('DELETE')
                    @csrf
                    <button type="submit" class="rounded-lg px-2 text-xs bg-transparent hover:bg-red
                    hover:text-white">Delete</button>
                </form>
            </footer>
    @endcan
</div>
