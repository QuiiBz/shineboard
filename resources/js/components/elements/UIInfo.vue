<template>
    <div :class="'infobox ' + type + (active ? ' active' : '')">{{ this.text }}</div>
</template>

<script>
    export default {

        props: ['active', 'type', 'text'],
    }
</script>

<style lang="scss">
    @import '../../../sass/themes/default';

    .infobox {

        position: absolute;
        top: 30px;
        opacity: 0;
        text-align: center;
        color: $background;
        padding: 10px 20px;
        border-radius: 0 0 5px 5px;
        transition: .3s ease;

        &.active {

            opacity: 1;
            top: 51px;
        }

        &.info {

            background: rgba($function, 0.6);
        }

        &.error {

            background: rgba($int, 0.6);
        }

        &.success {

            background: rgba($string, 0.6);
        }
    }
</style>
