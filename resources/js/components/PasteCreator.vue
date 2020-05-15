<template>
    <div class="paste-content">
        <textarea class="language-"></textarea>
    </div>
</template>

<script>
    export default { }
</script>

<style lang="scss">
    .paste-content {

        display: flex;
        flex-direction: column;
        height: inherit;

        & textarea {

            resize: none;
            box-sizing: border-box;
            height: 100%;
            background: none;
            border: none;
        }
    }
</style>
