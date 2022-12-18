<template>
    <div class="app">
            <router-view :key="contentKey"></router-view>
    </div>
</template>

<script>
export default {
    data() {
        return {
            spinner: false,
            contentKey: 1,
            'v-b-modal': false
        }
    },
    methods: {
        login() {
            var url = route('auth.me');
            this.axios.post(url).then(response => {
                // куда редиректнет после аунтитефикации
                var redirect_url = localStorage.getItem("redirect");
                this.$store.commit("setUserId", response.data.id);
                this.$store.commit("setUserFIO", response.data.name);
                this.$store.commit("setLoggedIn", true);

                if (this.$router.currentRoute.name == "login") {
                    if (redirect_url) {
                        this.$router.push(redirect_url);
                        localStorage.setItem("redirect", "");
                    } else {
                        this.$router.push('/app/client')
                    }
                }

            }).catch(error => { this.logout(); this.$noty.info('Автаризуйтесь в системе'); });
        },
        logout() {
            localStorage.setItem("token", "");
            localStorage.setItem("redirect", window.location.pathname);
            this.$router.push({ name: 'login' })
        },
        checkAuth() {
            // Установка токена в хедер запроса
            this.axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('token');

            // Проверка существования токена
            if (!localStorage.getItem('token')) {
                if (window.location.pathname != "/login") {
                    this.logout();
                }
            } 
            else {
                this.login();
            }

            this.axios.interceptors.request.use((config) => {
                this.spinner = true;
                return config;
            }, (error) => {
                this.spinner = false;
                return console.log('error');
            });
            
            this.axios.interceptors.response.use((response) => {
                this.spinner = false;
                console.log('finish')
                return response;
            }, (error) => {
                this.spinner = false;
                if (error.response.status == 402) {
                    this.$noty.error(error.response.data.message);
                } else {
                    this.$noty.error('Сервер отказал в подключении');
                }
                return console.log(error);
            });
        },
    },
    watch: {
        '$route'(to, from) {
            this.checkAuth();
            if (to.name == from.name) {
                this.contentKey++;
            }
        }
    },
    created() {
        this.checkAuth();
    },
    computed: {
    },
}
</script>

<style scoped>
.app {
    display: flex;
	width: 100%;
	height: 100vh;
}
</style>
