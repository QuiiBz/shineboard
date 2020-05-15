<template>
    <div class="paste-board">
        <u-i-info :active="this.saving" type="info" text="Saving your paste..." />
        <u-i-info :active="this.reseted" type="success" text="Paste reseted!" />
        <u-i-info :active="this.error" type="error" :text="this.error" />
        <u-i-info :active="this.saved" type="success" text="Paste saved! (Link copied to your clipboard)" />
        <div class="header">
            <div class="buttons">
                <u-i-language-selector :change="setLanguage" />
            </div>
            <input type="text" class="title" :style="'width: ' + inputWidth" @keypress="updateWidth" placeholder="Paste title" v-model="paste.title" />
            <div class="buttons">
                <u-i-button :action="save" icon="far fa-save" hover="Save paste" />
                <u-i-button :action="reset" icon="fas fa-trash-restore" hover="Reset paste"></u-i-button>
            </div>
        </div>
        <div class="paste-content">
            <textarea class="language-" placeholder="Paste your code here" v-model="paste.code"></textarea>
        </div>
    </div>
</template>

<script>
    import copy from '../utils/Clipboard';
    import UIButton from '../components/elements/UIButton';
    import UILanguageSelector from '../components/elements/UILanguageSelector';
    import UIInfo from '../components/elements/UIInfo';

    export default {

        components: {

            UIButton,
            UILanguageSelector,
            UIInfo,
        },
        data() {

            return {

                paste: {

                    title: 'Untitled',
                    language: 'javascript',
                    code: '',
                },
                saving: false,
                reseted: false,
                saved: false,
                error: '',
                inputWidth: '',
            }
        },
        mounted() {

            this.updateWidth();

            document.addEventListener('keydown', this.doSave);
        },
        beforeDestroy() {

            document.removeEventListener('keydown', this.doSave);
        },
        methods: {

            updateWidth() {

                this.inputWidth = ((this.paste.title.length + 4) * 8) + 'px';
            },
            setLanguage(language) {

                this.paste.language = language;
            },
            doSave(event) {

                if(!(event.keyCode === 83 && event.ctrlKey))
                    return;

                event.preventDefault();
                this.save();
            },
            save() {

                this.saving = true;
                this.error = '';

                axios.post('/paste', {

                    user: 'none',
                    language: this.paste.language,
                    title: this.paste.title,
                    code: this.paste.code,

                }).then((response) => {

                    const { saved, slug } = response.data;

                    if(saved) {

                        this.saving = false;
                        this.saved = true;

                        copy( `${process.env.MIX_APP_URL}/${slug}`);

                        setTimeout(() => {

                            this.saved = false;
                            this.$router.push(`/${slug}`);

                        }, 1000);

                    } else {

                        const { errors } = response.data;

                        this.saving = false;
                        this.error = errors;

                        setTimeout(() => this.error = '', 5000);
                    }

                }).catch((error) => {

                    this.error = error.message.errors;
                });
            },
            reset() {

                this.reseted = true;
                this.error = '';

                this.paste = {

                    title: 'Untitled',
                    language: 'javascript',
                    code: '',
                };

                setTimeout(() => this.reseted = false, 1000);
            },
        }
    }
</script>

<style lang="scss">
    @import '../../sass/themes/default';

    .paste-board {

        width: calc(80vw - 100px);
        height: calc(100vh - 150px);
        margin: 50px auto;
        border-radius: 40px;
        background-color: $background;
        display: flex;
        flex-direction: column;
        border: 3px solid #000000;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.4);

        ::-webkit-scrollbar {

            width: 12px;
        }

        ::-webkit-scrollbar-track {

            background: none;
        }

        ::-webkit-scrollbar-thumb {

            border-radius: 5px;
            background: $header-background;
        }

        .header {

            width: 100%;
            min-height: 55px;
            border-bottom: 1px solid $header-background;
            border-radius: 40px 40px 0 0;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;

            .buttons {

                display: flex;
                align-items: center;
                margin: 0 25px;
            }

            .title {

                text-align: center;
                font-size: 20px;
                color: $color;
                margin: 10px 0;
                background: none;
                border: none;
                padding: 8px 12px;
                border-radius: 10px;

                &:focus {

                    background: $header-background;
                }
            }
        }

        .paste-content {

            padding: 20px;
            display: flex;
            flex-direction: column;
            height: 100%;

            & textarea {

                resize: none;
                box-sizing: border-box;
                height: 100%;
                background: none;
                border: none;
            }
        }
    }

    @media screen and (max-width: 1024px) {

        .paste-board {

            width: calc(100vw - 40px);

            .header {

                flex-wrap: wrap;
                justify-content: center;
                height: auto;
            }
        }
    }
</style>
