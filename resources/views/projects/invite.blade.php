<div class="card flex flex-col mt-3" style="height: 200px">
    <h3 class="text-decoration-none font-bold text-xl py-4 -ml-5 mb-3 border-l-4 border-accent-light
                    pl-4">
        Invite a User
    </h3>

    <form method="POST" action="{{ $project->path(). '/invitations'}}">
        @csrf

        <div class="mb-3">
            <input
                type="email"
                name="email"
                class="border border-grey-light rounded py-2 px-3"
                style="min-width:90%;"
                Placeholder="Email address"
            >
        </div>

        <button type="submit" class="rounded-lg px-3 py-2 text-xs bg-blue text-white">
            Invite
        </button>
    </form>
    @include ('errors', ['bag' => 'invitations'])
</div>
