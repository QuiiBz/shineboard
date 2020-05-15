<template>
    <div class="paste-board">
        <div :class="'fetching' + (this.fetching ? ' active' : '')">Fetching paste...</div>
        <div :class="'error' + (this.error ? ' active' : '')">{{ this.error }}</div>
        <div class="header">
            <div class="buttons">
                <div @click.prevent="newPaste" class="button">
                    <i class="far fa-file-alt"></i>
                    <span class="info">New paste</span>
                </div>
            </div>
            <p class="title">{{ this.paste.title }}</p>
            <div class="buttons">
                <div @click.prevent="raw" class="button">
                    <i class="far fa-file"></i>
                    <span class="info">Open raw</span>
                </div>
            </div>
        </div>
        <paste-content v-if="!this.fetching" class="paste" :language="this.paste.language">{{ this.paste.code }}</paste-content>
    </div>
</template>

<script>
    import PasteContent from '../components/PasteContent';

    export default {

        components: {
            PasteContent,
        },
        data() {

            return {

                paste: {

                    user: '',
                    language: '',
                    title: '...',
                    code: ''
                },
                fetching: true,
                error: '',
            }
        },
        mounted() {

            axios.get(`/paste/${this.$route.params.slug}`).then((response) => {

                this.fetching = false;

                const result = response.data;

                if(result.exist)
                    this.paste = result;
                else
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

                window.open(`http://localhost:8000/raw/${this.$route.params.slug}`, '_blank');
            },
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
    }
</style>
