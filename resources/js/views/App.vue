<template>
    <div>
        <header>
            <div class="container">
                <router-link :to="{ name: 'home' }"><img class="logo" src="/storage/logo.png" alt="Logo" /></router-link>
                <div class="buttons">
                    <u-i-button :action="openGithub" icon="fab fa-github" />
                    <u-i-button :action="openTwitter" icon="fab fa-twitter"/>
                </div>
            </div>
        </header>
        <router-view />
    </div>
</template>

<script>
    import PasteBoard from './CreatePaste';
    import UIButton from '../components/elements/UIButton';

    export default {

        components: {

            UIButton,
            PasteBoard,
        },
        methods: {

            openGithub() {

                window.open('https://github.com/ShineBoard/shineboard', '_blank');
            },

            openTwitter() {

                window.open('https://twitter.com/ShineBoard', '_blank');
            },
        },
    }
</script>

<style lang="scss">
    @import '../../sass/themes/default.scss';

    body {

        margin: 0;
        padding: 0;
        background: $selection-background;
        font-family: 'Nunito', sans-serif;
        overflow-y: hidden;
    }

    *:focus {

        outline: none;
    }

    *::-moz-selection {

        color: $selection-foreground;
        background: $selection-background;
    }

    *::selection {

        color: $selection-foreground;
        background: $selection-background;
    }

    header {

        width: 100vw;
        height: 50px;
        border-bottom: 1px solid $header-background;
        background: $background;

        .container {

            width: 50vw;
            height: 50px;
            margin: auto;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;

            .logo {

                width: 40px;
                height: 40px;
            }

            .buttons {

                display: flex;
                flex-direction: row;
            }
        }
    }

    @media screen and (max-width: 1024px) {

        header .container {

            width: 80vw;
        }
    }
</style>
