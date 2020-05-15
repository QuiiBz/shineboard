<template>
    <div ref="codeBlock">
        <pre :class="this.languageClass"><code><slot /></code></pre>
    </div>
</template>

<script>
    import hljs from 'highlight.js';

    export default {

        props: ['language'],
        computed: {

            languageClass() {

                return `language-${this.language}`;
            },
        },
        methods: {

            highlight() {

                document.querySelectorAll('pre code').forEach((block) => {

                    hljs.highlightBlock(block);
                });
            }
        },
        mounted() {

            this.highlight();
        },
    }
</script>
