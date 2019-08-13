<template>
    <modal name="new-project" classes="p-10 bg-card rounded-lg" height="auto">
        <h1 class="font-normal mb-16 text-center text-2xl">Let's get started!</h1>

        <form @submit.prevent="submit">
            <div class="flex">
                <!-- left side -->
                <div class="flex-1 mr-4">
                    <div class="mb-4">
                        <label for="title" class="mb-2 text-sm block">Title</label>

                        <input
                            type="text"
                            id="title"
                            :class="form.errors.title ? 'border-error' :
                            'border-muted-light'"
                            class="border-muted-light border p-2 text-xs block w-full rounded-lg"
                            v-model="form.title">
                        <span
                            class="text-xs italic text-error"
                            v-if="form.errors.title"
                            v-text="form.errors.title[0]">
                        </span>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="mb-2 text-sm block">Description</label>

                        <textarea
                            id="description"
                            class="border-muted-light border p-2 text-xs block w-full rounded-lg"
                            :class="form.errors.description ? 'border-error'
                            : 'border-muted-light'"
                            rows="7"
                            v-model="form.description"
                        ></textarea>
                        <span
                            class="text-xs italic text-error"
                            v-if="form.errors.description"
                            v-text="form.errors.description[0]"></span>
                    </div>
                </div>

                <!-- right side -->
                <div class="flex-1 ml-4">
                    <div class="mb-4">
                        <label class="mb-2 text-sm block">Got Task? </label>
                        <input
                            type="text"
                            class="border-muted-light border mb-2 p-2 text-xs block w-full rounded-lg"
                            placeholder="Add Task"
                            v-for="task in form.tasks"
                            v-model="task.body"
                        >
                    </div>

                    <button
                        type="button"
                        class="text-xs border-none inline-flex align-items-center focus:outline-none mb-8"
                        style="background:transparent;"
                        @click="addTask"
                    >
                        <svg
                            class="mr-2"
                            height="auto"
                            viewBox="0 0 512 512"
                            width="12pt"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="m437.019531 74.980469c-48.351562-48.351563-112.640625-74.980469-181.019531-74.980469s-132.667969 26.628906-181.019531 74.980469c-48.351563 48.351562-74.980469 112.640625-74.980469 181.019531s26.628906 132.667969 74.980469 181.019531c48.351562 48.351563 112.640625 74.980469 181.019531 74.980469s132.667969-26.628906 181.019531-74.980469c48.351563-48.351562 74.980469-112.640625 74.980469-181.019531s-26.628906-132.667969-74.980469-181.019531zm-181.019531 397.019531c-119.101562 0-216-96.898438-216-216s96.898438-216 216-216 216 96.898438 216 216-96.898438 216-216 216zm20-236.019531h90v40h-90v90h-40v-90h-90v-40h90v-90h40zm0 0">
                            </path>
                        </svg>
                        <span class="my-auto">Add New Task Field</span>
                    </button>
                </div>
            </div>

            <footer class="flex justify-end">
                <button type="button"
                        class="button mr-4 is-outlined"
                        @click="$modal.hide('new-project')"
                >
                    Cancel
                </button>
                <button class="button">Create Project</button>
            </footer>
        </form>

    </modal>
</template>

<script>
    import TeamWorkForm from './TeamWorkForm';

    export default {
        data() {
            return {
                form: new TeamWorkForm({
                    title: '',
                    description: '',
                    tasks: [
                        { body: ''},
                    ]
                })
            };
        },
        methods: {
            addTask() {
                this.form.tasks.push({ body: '' });
            },
            async submit() {
                if (! this.form.tasks[0].body) {
                    delete this.form.originalData.tasks;
                }
                this.form.submit('/projects')
                    .then(response => location = response.data.message);
            }
        }
    }
</script>
