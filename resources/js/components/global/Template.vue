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
            <Button text="Добавить" :round="false" :withIcon="true" icon="add" @b-click="addTemplate"></Button>
            <div class="table">
                <TableElem v-for="(elem, index) in templates" :key="index" :id="elem.id" :text="elem.name">
                    <IconButton :idData="{id: index}" icon="edit" @b-i-click="editTemplate"></IconButton>
                </TableElem>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            templates: []
        }
    },
    methods: {
        getTemplate() {
            var url = '/api/sample'
            this.axios.get(url).then(response => {
                this.templates = response.data
            }).catch(error => { this.$noty.info('Неудалось получить шаблоны'); });
        },
        editTemplate(e) {
            this.$router.push(`/app/template/${this.templates[e.id].id}/action/edit`)
        },
        addTemplate() {
            this.$router.push('/app/template/action/create')
        }
    },
    created() {
        this.getTemplate()
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