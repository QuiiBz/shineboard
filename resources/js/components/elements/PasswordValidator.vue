<template>
    <div @keypress.enter.prevent="tryPassword" class="background">
        <u-i-input placeholder="Password" :change="setPassword" hidden="true" :error="this.error" autofocus></u-i-input>
        <u-i-button :action="tryPassword" icon="fas fa-unlock-alt" hover="Unlock paste" />
    </div>
</template>

<script>
    import UIInput from './UIInput';
    import UIButton from './UIButton';

    export default {

        components: {

            UIInput,
            UIButton,
        },
        props: ['slug', 'validate'],
        data() {

            return {

                password: '',
                error: false,
            }
        },
        methods: {

            setPassword(password) {

                this.password = password;
                this.error = false;
            },
            tryPassword() {

                axios.post('/paste/unlock', {

                    slug: this.slug,
                    password: this.password,

                }).then((response) => {

                    const { success } = response.data;

                    if(success)
                        this.validate(response.data);
                    else
                        this.error = true;
                });
            }
        }
    }
</script>

<style lang="scss">
    .background {

        width: 100vw;
        height: 100vh;
        position: absolute;
        top: 0;
        left: 0;
        background: rgba(0, 0, 0, 0.7);
        backdrop-filter: blur(5px);
        display: flex;
        justify-content: center;
        align-items: center;

        input {

            margin-right: 10px;
        }
    }
</style>
