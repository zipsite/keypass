<template>
    <div class="wrapper-main-page">
        <div class="header">
            <p class="you-headline-small">Keypass</p>
            <Button text="Выйти" type="text" @b-click="logout"></Button>
        </div>
        <div class="nav">
            <NavElem v-for="elem in navElems" :key="elem.id" v-bind="elem" @nav-elem="onNavElemClick"></NavElem>

        </div>
        <div class="main">
            <div>
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            navElems: [
            {id: 0, text: "Клиенты", icon: "person", active: true, path: '/app/client'},
            {id: 1, text: "Шаблоны", icon: "draft", active: false, path: '/app/template'},
            ]
        }
    },
    methods: {
        onNavElemClick(e) {
            for (let elem of this.navElems) {
                elem.active = false
            }
            this.navElems[e].active = true;
            this.$router.push(this.navElems[e].path)
        },
        logout() {
            localStorage.setItem("token", "");
            localStorage.setItem("redirect", window.location.pathname);
            this.$router.push({ name: 'login' })
        },
    }
}
</script>

<style>
.wrapper-main-page {
    width: 100%;
    height: 100%;
    display: grid;
    grid-template-columns: 280px 1fr;
    grid-auto-rows: 64px 1fr;
    grid-template-areas:
        "h h"
        "n m"
        "n m";
}

.header {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    padding: 12px 16px;
    gap: 10px;

    grid-area: h;

    background-color: var(--surface);
}

.nav {
    display: flex;
    flex-direction: column;
    align-items: stretch;
    padding: 12px;

    grid-area: n;

    background-color: var(--surface);
}

.main {
    grid-area: m;
}

.main > div {
    max-width: 1200px;
    margin: 0 auto;
}
</style>