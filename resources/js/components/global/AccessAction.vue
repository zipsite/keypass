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
                <Input v-model="objectData.sample_id" label="id шаблона"></Input>
                <GroupInputs label="Данные для заполнения">
                    <textarea v-model="objectData.data" class="cos-input"></textarea>
                </GroupInputs>
                <Button text="Сохранить" @b-click="addAccess"></Button>
            </GroupInputs>
            <GroupInputs label="Важное">
                <Button type="error" text="Удалить" @b-click="deleteAccess"></Button>
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
            this.$router.push(`/app/client/${this.$route.params.clientId}/access`)
        },
        setAction() {
            this.action = this.$route.params.action
        },
        loadAccess() {
            if (this.action == 'edit') {
                var url = `/api/client/${this.$route.params.clientId}/access/${this.$route.params.accessId}`
                this.axios.get(url).then(response => {
                    this.objectData = response.data
                    this.objectData.data = JSON.stringify(response.data.data)
                }).catch(error => { this.$noty.info('Неудалось получить доступ'); });
            }
            else if (this.action == 'create') {
                console.log('create')
                this.objectData = {
                    name: '',
                    client_id: this.$route.params.clientId,
                    sample_id: '',
                    data: ''
                }
            }
        },
        addAccess() {
            if (this.action == 'create') {
                var url = `/api/client/${this.$route.params.clientId}/access`
                this.axios.post(url, {
                    name: this.objectData.name,
                    client_id: this.objectData.client_id,
                    sample_id: this.objectData.sample_id,
                    data: JSON.parse(this.objectData.data)
                }).then(response => {
                    this.onBack()
                }).catch(error => {
                    this.$noty.info('Не удалось создать доступ');
                });
            }
            else if (this.action == 'edit') {
                var url = `/api/client/${this.$route.params.clientId}/access/${this.$route.params.clientId}`
                this.axios.put(url, {
                    name: this.objectData.name,
                    client_id: this.objectData.client_id,
                    sample_id: this.objectData.sample_id,
                    data: JSON.parse(this.objectData.data)
                }).then(response => {
                    this.onBack()
                }).catch(error => {
                    this.$noty.info('Не удалось отредактировать клиента');
                });
            }
        },
        deleteAccess() {
            var url = `/api/client/${this.$route.params.clientId}/access/${this.$route.params.clientId}`
            this.axios.delete(url).then(response => {
                this.onBack()
            }).catch(error => { this.$noty.info('Неудалось удалить клиента'); });
        },

    },
    computed: {
        nameActivity() {
            if (this.action == 'create') {
                return 'Создание доступа'
            }
            else if (this.action == 'edit') {
                return 'Редактирование доступа'
            }
        },
    },
    created() {
        this.setAction()
        this.loadAccess()

    }
}
</script>

<style>
.activity {
    border: 4px solid var(--primary-container);
}
.cos-input {
    width: 100%;
    resize: vertical;
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