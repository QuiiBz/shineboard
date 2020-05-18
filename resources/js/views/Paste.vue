<template>
    <div class="paste-board">
        <u-i-info :active="this.fetching" type="info" text="Fetching paste..."/>
        <u-i-info :active="this.error" type="error" :text="this.error"/>
        <div class="header">
            <div class="buttons">
                <u-i-button :action="newPaste" icon="far fa-file-alt" hover="New paste" />
                <p class="paste-language">{{ this.paste.language }}</p>
            </div>
            <p class="title">{{ this.paste.title }}</p>
            <div class="buttons">
                <u-i-button v-if="!this.error" :action="raw" icon="far fa-file" hover="Open raw" />
            </div>
        </div>
        <paste-content v-if="!this.fetching && !this.paste.private" class="paste" :language="this.paste.language">{{ this.paste.code }}</paste-content>
        <password-validator v-if="this.paste.private" :slug="this.slug" :validate="setPaste" />
    </div>
</template>

<script>
    import PasteContent from '../components/PasteContent';
    import UIButton from '../components/elements/UIButton';
    import UIInfo from '../components/elements/UIInfo';
    import PasswordValidator from '../components/elements/PasswordValidator';

    export default {

        components: {
            PasteContent,
            UIButton,
            UIInfo,
            PasswordValidator,
        },
        data() {

            return {

                paste: {

                    user: '',
                    language: '',
                    title: '...',
                    code: '',
                    private: false,
                },
                fetching: true,
                error: '',
            }
        },
        mounted() {

            axios.get(`/paste/${this.slug}`).then((response) => {

                this.fetching = false;

                const result = response.data;

                if(result.exist) {

                    if(result.private)
                        this.paste.private = true;
                    else
                        this.paste = result;

                } else
                    this.error = 'This paste does not exist';

            }).catch((error) => {

                this.error = error.message.errors;
            });
        },
        methods: {

            newPaste() {

                this.$router.push('/');
            },
            raw() {

                window.open(`${process.env.MIX_APP_URL}/raw/${this.$route.params.slug}`, '_blank');
            },
            setPaste(data) {

                this.paste = data;
            },
        },
        computed: {

            slug() {

                return this.$route.params.slug;
            }
        }
    }
</script>

<style lang="scss">
    @import '../../sass/themes/default';

    .paste-board {

        .fetching, {

            position: absolute;
            top: -50px;
            text-align: center;
            color: $background;
            background: rgba($function, 0.6);
            padding: 10px 20px;
            border-radius: 0 0 5px 5px;
            transition: .3s ease;

            &.active {

                top: 0;
            }
        }

        .paste {

            padding: 20px;
            overflow-y: scroll;
            margin-bottom: 30px;
        }

        .paste-language {

            font-size: 16px;
            color: #b7b7b7;
            padding: 11px 12px;
            margin: 0;
        }
    }
</style>
