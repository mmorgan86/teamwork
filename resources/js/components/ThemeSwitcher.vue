<template>
    <div class="flex align-items-center mr-8 ">
        <button
            v-for="(color, theme) in themes"
            class="rounded w-4 h-4 bg-default border mr-2 focus:outline-none"
            :class="{ 'border-accent': selectedTheme == theme }"
            :style="{ backgroundColor: color }"
            @click="selectedTheme = theme"
        ></button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                themes: {
                    'theme-light': '#F5F6F9',
                    'theme-dark': '#1f2027',
                    'theme-girly': '#98dbc6',
                    'theme-blue': '#283655',
                },
                selectedTheme: 'theme-light'
            };
        },

        created() {
            this.selectedTheme = localStorage.getItem('theme') || 'theme-light';
        },

        watch: {
            selectedTheme() {
                document.body.className =
                document.body.className.replace(/theme-\w+/,
                    this.selectedTheme);

                localStorage.setItem('theme', this.selectedTheme);
            }
        }
    }
</script>
