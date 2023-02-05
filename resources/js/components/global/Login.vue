<template>
    <div class="wrapper-login">
        <div class="form-container">
            <Input v-model="email" label="Email" type="email"></Input>
            <Input v-model="password" label="Пароль" type="password"></Input>
            <Button text="Войти" @b-click="submitLogin"></Button>
        </div>
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
                    this.$router.push({ name: 'widgets' })
                }
            }).catch(error => {
                this.$noty.info('Не верный логин и/или пароль');
            });
        }
    },

}
</script>
<style scoped>
.wrapper-login {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100vh;
}

.form-container {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    padding: 16px;
    gap: 16px;
}
</style>

