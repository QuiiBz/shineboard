<template>
    <input :class="'input ' + (this.error ? 'error' : '')" :placeholder="this.placeholder" :value="this.value" @input="onChange($event)">
</template>

<script>
    export default {

        props: ['placeholder', 'value', 'change', 'hidden', 'error'],
        methods: {

            onChange(event) {

                this.change(event.target.value);
            },
        }
    }
</script>

<style lang="scss">
    @import '../../../sass/themes/default';

    .input {

        font-size: 16px;
        color: #b7b7b7;
        padding: 11px 12px;
        border-radius: 10px;
        background: $header-background;
        border: none;
        transition: .3s ease;

        &.error {

            border: 1px solid $name;
        }
    }
</style>
