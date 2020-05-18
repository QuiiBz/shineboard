<template>
    <div class="paste-board">
        <u-i-info :active="this.saving" type="info" text="Saving your paste..." />
        <u-i-info :active="this.reseted" type="success" text="Paste reseted!" />
        <u-i-info :active="this.error" type="error" :text="this.error" />
        <u-i-info :active="this.saved" type="success" text="Paste saved! (Link copied to your clipboard)" />
        <div class="header">
            <div class="buttons">
                <u-i-button :action="save" icon="far fa-save" hover="Save paste" />
                <u-i-language-selector :change="setLanguage" />
            </div>
            <input type="text" class="title" :style="'width: ' + inputWidth" @keypress="updateWidth" placeholder="Paste title" v-model="paste.title" />
            <div class="buttons">
                <u-i-button :action="reset" icon="fas fa-trash-restore" hover="Reset paste" />
                <u-i-button :action="settings" icon="fas fa-cogs" hover="Settings" id="settings" />
            </div>
            <div v-if="this.showSettings" class="settings">
                <u-i-checkbox :action="togglePrivate" :checked="this.paste.private" text="Does this paste should be private ?" />
                <u-i-input v-if="this.paste.private" placeholder="Password" :value="this.paste.private" :change="setPassword" />
            </div>
        </div>
        <div class="paste-content">
            <paste-creator :change="setCode" :language="this.paste.language"/>
        </div>
    </div>
</template>

<script>
    import copy from '../utils/Clipboard';
    import UIButton from '../components/elements/UIButton';
    import UILanguageSelector from '../components/elements/UILanguageSelector';
    import UIInfo from '../components/elements/UIInfo';
    import PasteCreator from '../components/PasteCreator';
    import UICheckbox from '../components/elements/UICheckbox';
    import UIInput from '../components/elements/UIInput';

    export default {

        components: {

            UIButton,
            UILanguageSelector,
            UIInfo,
            PasteCreator,
            UICheckbox,
            UIInput,
        },
        data() {

            return {

                paste: {

                    title: 'Untitled',
                    language: 'javascript',
                    code: '',
                    private: null,
                },
                saving: false,
                reseted: false,
                saved: false,
                error: '',
                inputWidth: '',
                showSettings: false,
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
                    private: this.paste.private,

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
                    private: null,
                };

                setTimeout(() => this.reseted = false, 1000);
            },
            settings() {

                this.showSettings = !this.showSettings;
            },
            togglePrivate() {

                if(!this.paste.private)
                    this.paste.private = 'mypass';
                else
                    this.paste.private = null;
            },
            setPassword(password) {

                this.paste.private = password;
            },
            setCode(code) {

                this.paste.code = code;
            }
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
                margin: auto 25px;
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

            .settings {

                position: absolute;
                top: 160px;
                right: calc(10vw + 50px);
                width: auto;
                height: auto;
                padding: 20px;
                margin: 10px;
                border-radius: 20px;
                background-color: #263238;
                border: 1px solid #000000;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.4);
                display: flex;
                flex-direction: column;
            }
        }

        .paste-content {

            padding: 20px;
            display: flex;
            flex-direction: column;
            height: 100%;
            overflow: hidden;
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
