<template>
    <div class="activity">
        <div class="activity-header">
            <IconButton icon="close" @b-i-click="onBack"></IconButton>
            <div class="activity-header-place-text">
                <p class="you-title-large">
                    {{ nameActivity }}
                </p>
            </div>
        </div>
        <div class="activity-content">
            <GroupInputs label="Основное">
                <Input v-model="objectData.name" label="Имя"></Input>
                <Button text="Сохранить" @b-click="addClient"></Button>
            </GroupInputs>
            <GroupInputs label="Важное">
                <Button type="error" text="Удалить" @b-click="deleteClient"></Button>
            </GroupInputs>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            objectData: {},
            action: ''
        }
    },
    methods: {
        onBack() {
            this.$router.push(`/app/client`)
        },
        setAction() {
            this.action = this.$route.params.action
        },
        loadClient() {
            if (this.action == 'edit') {
                var url = `/api/client/${this.$route.params.clientId}`
                this.axios.get(url).then(response => {
                    this.objectData = response.data
                }).catch(error => { this.$noty.info('Неудалось получить клиента'); });
            }
            else if (this.action == 'create') {
                console.log('create')
                this.objectData = {
                    name: ''
                }
            }
        },
        addClient() {
            if (this.action == 'create') {
                var url = '/api/client/'
                this.axios.post(url, {
                    name: this.objectData.name,
                }).then(response => {
                    this.onBack()
                }).catch(error => {
                    this.$noty.info('Не удалось создать клиента');
                });
            }
            else if (this.action == 'edit') {
                var url = `/api/client/${this.$route.params.clientId}`
                this.axios.put(url, {
                    name: this.objectData.name,
                }).then(response => {
                    this.onBack()
                }).catch(error => {
                    this.$noty.info('Не удалось отредактировать клиента');
                });
            }
        },
        deleteClient() {
            var url = `/api/client/${this.$route.params.clientId}`
            this.axios.delete(url).then(response => {
                this.onBack()
            }).catch(error => { this.$noty.info('Неудалось удалить клиента'); });
        },

    },
    computed: {
        nameActivity() {
            if (this.action == 'create') {
                return 'Создание клиента'
            }
            else if (this.action == 'edit') {
                return 'Редактирование клиента'
            }
        },
    },
    created() {
        this.setAction()
        this.loadClient()
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
</style>