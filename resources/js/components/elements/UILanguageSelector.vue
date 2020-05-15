<template>
    <select class="selector" @change="onChange($event)">
        <option value="javascript">JavaScript</option>
        <option value="php">TypeScript</option>
        <option value="java">Java</option>
        <option value="kotlin">Kotlin</option>
        <option value="swift">Swift</option>
        <option value="python">Python</option>
        <option value="json">JSON</option>
        <option value="yaml">YAML</option>
        <option value="php">PHP</option>
        <option value="css">CSS</option>
        <option value="scss">SCSS</option>
        <option value="less">Less</option>
        <option value="c++">C++</option>
        <option value="c#">C#</option>
        <option value="c">C</option>
        <option value="ruby">Ruby</option>
        <option value="rust">Rust</option>
        <option value="lua">Lua</option>
        <option value="go">Go</option>
        <option value="SQL">SQL</option>
        <option value="markdown">Markdown</option>
        <option value="html">HTML</option>
        <option value="xml">XML</option>
        <option value="bash">Bash</option>
    </select>
</template>

<script>
    export default {

        props: ['change'],
        methods: {

            onChange(event) {

                this.change(event.target.value);
            },
        }
    }
</script>

<style lang="scss">
    @import '../../../sass/themes/default';

    .selector {

        font-size: 16px;
        color: $color;
        padding: 11px 12px;
        border-radius: 10px;
        position: relative;
        cursor: pointer;
        background: none;
        border: none;

        * {

            background: $header-background;
        }

        &:hover {

            background: $header-background;
        }
    }
</style>
