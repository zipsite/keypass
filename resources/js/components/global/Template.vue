<template>
    <div class="activity">
        <div class="activity-header">
            <div class="activity-header-place-text">
                <p class="you-title-large">
                    Шаблоны
                </p>
            </div>
        </div>
        <div class="activity-content">
            <Button text="Добавить" :round="false" :withIcon="true" icon="add"></Button>
            <div class="table">
                <TableElem v-for="(elem, index) in clients" :id="elem.id" :text="elem.name">
                    <IconButton :idData="{id: index, type: 'edit'}" icon="edit" @b-i-click="clickButton"></IconButton>
                </TableElem>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            clients: []
        }
    },
    methods: {
        getClient() {
            var url = '/api/sample'
            this.axios.get(url).then(response => {
                this.clients = response.data
            }).catch(error => { this.$noty.info('Неудалось получить шаблоны'); });
        },
        clickButton(e){
            if (e.type == 'edit') {
                console.log(this.clients[e.id].name)
            }
            else if (e.type == 'open') {
                console.log(this.clients[e.id].id)
            }
        }
    },
    created() {
        this.getClient()
    }
}
</script>

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