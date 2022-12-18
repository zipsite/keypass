<template>
    <div class="table-elem">
        <div class="table-elem-text">
            <p class="you-title-medium">ООО ВОТЕЛ</p>
        </div>
        <Button></Button>
    </div>
</template>

<style>
.table-elem {
    display: flex;
    flex-direction: row;
    align-items: flex-start;
    padding: 12px 16px;
    gap: 12px;
    background-color: var(--surface);
    border-bottom: 1px solid var(--on-primary-container);
}

.table-elem-text {
    display: flex;
    flex-direction: row;
    align-items: flex-start;
    padding: 8px 0px;
    flex-grow: 1;
}
</style>