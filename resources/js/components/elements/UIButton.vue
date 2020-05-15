<template>
    <div @click.prevent="action" class="button">
        <i :class="this.icon"></i>
        <span v-if="this.hover" class="info">{{ this.hover }}</span>
    </div>
</template>

<script>
    export default {

        props: ['action', 'icon', 'hover']
    }
</script>

<style lang="scss">
    @import '../../../sass/themes/default';

    .button {

        font-size: 22px;
        color: $color;
        padding: 8px 12px;
        border-radius: 10px;
        position: relative;
        cursor: pointer;

        &:hover {

             background: $header-background;
        }

        .info {

            position: absolute;
            left: 50%;
            bottom: 110%;
            opacity: 0;
            padding: 4px 6px;
            background-color: rgba(0, 0, 0, 0.7);
            font-size: 14px;
            white-space: nowrap;
            border-radius: 4px;
            transform: translate(-50%);

            &::before {

                 content: '';
                 position: absolute;
                 top: 100%;
                 left: 50%;
                 width: 0;
                 height: 0;
                 transform: translate(-50%);
             }
        }

        &:hover .info {

             opacity: 1;
             transform: translate(-50%);
        }
    }
</style>
