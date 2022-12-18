<template>
    <div class="form-container">
        <label for="email">email</label>
        <input v-model="email" id="email">
        <label for="password">password</label>
        <input v-model="password" id="password">
        <button v-on:click="submitLogin()">Войти</button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                email: '',
                password: '',
            }
        },
        head: {
            title: {
                inner: 'Авторизация',
            },
        },
        methods: {
            submitLogin() {
                var url = route('auth.login');
                this.axios.post(url, {
                    email: this.email,
                    password: this.password
                }).then(response => {
                    axios.defaults.headers.common['Authorization'] = 'Bearer ' + response.data.access_token;

                    localStorage.setItem('token', response.data.access_token);

                    var redirect_url = localStorage.getItem("redirect");
                    if (redirect_url) {
                        this.$router.push(redirect_url);
                        localStorage.setItem("redirect", "");
                    } else {
                        this.$router.push({name: 'widgets'})
                    }
                }).catch(error => {
                    this.$noty.info('Не верный логин и/или пароль');
                });
            }
        },

    }
</script>
<style scoped>
    
</style>

