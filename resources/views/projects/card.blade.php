
<div class="card" style="height: 200px;">
    <h3 class="border-light-blue font-normal text-xl py-5 pl-4 -ml-5" style="border-left: 8px solid #47cdff;">
        <a href=" {{ $project->path() }}" class='text-black no-underline'>
            {{ $project->title }}
        </a>
    </h3>

    <div class="text-grey">{{ str_limit($project->description, 100) }}</div>
</div>
