<template>
    <pre class="paste-creator">
        <code @input="highlight" :class="'editable ' + this.languageClass" id="editable" contenteditable spellcheck="false"></code>
    </pre>
</template>

<script>
    import hljs from 'highlight.js';
    import rangy from 'rangy/lib/rangy-selectionsaverestore';

    export default {

        props: ['language'],
        computed: {

            languageClass() {

                return `language-${this.language}`;
            },
        },
        methods: {

            highlight() {

                const element = document.getElementById('editable');
                const selection = rangy.saveSelection();
                const rangyRange = document.querySelector('.rangySelectionBoundary');

                element.innerHTML = element.innerText;
                element.appendChild(rangyRange);

                hljs.highlightBlock(element);

                rangy.restoreSelection(selection);
            },
        },
        mounted() {

            document.querySelector('#editable').addEventListener('keydown', (event) => {

                if(event.keyCode === 9) {

                    event.preventDefault();

                    const range = window.getSelection().getRangeAt(0);
                    const tabNode = document.createTextNode("\u00a0\u00a0\u00a0\u00a0");

                    range.insertNode(tabNode);
                    range.setStartAfter(tabNode);
                    range.setEndAfter(tabNode);
                }
            });

            this.highlight();
        },
    }
</script>

<style lang="scss">
    .paste-creator {

        height: 100%;
        margin: 0;

        .editable {

            display: block;
            width: 100%;
            height: 100%;
            overflow: scroll;
        }
    }
</style>
