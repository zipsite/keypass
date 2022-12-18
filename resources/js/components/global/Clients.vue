<template>
    <div class="activity">
        <div class="activity-header">
            <!-- <div class="activity-header-place-icon"></div> -->
            <div class="activity-header-place-text">
                <p class="you-title-large">
                    Клиенты
                </p>
            </div>
        </div>
        <div class="activity-content">
            <Button text="Добавить"></Button>
            <div class="table">
                <TableElem></TableElem>
            </div>
        </div>
    </div>
</template>

<style>
.activity {
    border: 4px solid var(--primary-container);
}

.activity-header {
    display: flex;
    flex-direction: row;
    align-items: center;
    padding: 12px 16px;
    gap: 8px;
    background: var(--primary-container);
}

.activity-header-place-text {
    display: flex;
    padding: 6px 0px;
    gap: 10px;
}

.activity-content {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    padding: 16px;
    gap: 16px;
}

.table {
    display: flex;
    flex-direction: column;
    align-items: stretch;
    align-self: stretch;
}
</style>