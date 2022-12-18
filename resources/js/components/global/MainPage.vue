<template>
    <div class="wrapper">
        <div class="header">
            <p class="you-headline-small">Keypass</p>
            <Button text="Выйти"></Button>
        </div>
        <div class="nav">
            <NavElem text="Клиенты"></NavElem>
            <NavElem text="Шаблоны"></NavElem>
        </div>
        <div class="main">
            <div>
                <router-view></router-view>
            </div>
        </div>
    </div>
</template>
<style>
.wrapper {
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