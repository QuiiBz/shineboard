<template>
    <div class="checkbox">
        <button type="button" @click.prevent="action" :class="'checkbox-box ' + (this.checked ? 'active' : '')"></button>
        <p class="checkbox-text">{{ this.text }}</p>
    </div>
</template>

<script>
    export default {

        props: ['action', 'checked', 'text'],
    }
</script>

<style lang="scss">
    @import '../../../sass/themes/default';

    .checkbox {

        display: flex;
        align-items: center;
        margin-bottom: 5px;

        .checkbox-box {

            width: 20px;
            height: 20px;
            border-radius: 4px;
            background: $header-background;
            cursor: pointer;
            margin-right: 10px;
            border: none;
            padding: 0;

            &.active::after {

                display: block;
                content: "";
                position: relative;
                left: 5px;
                width: 10px;
                height: 10px;
                background: $string;
            }
        }

        .checkbox-text {

            font-size: 14px;
            margin: 0;
            color: $color;
        }
    }
</style>
