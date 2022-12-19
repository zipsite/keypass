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
                <Input v-model="objectData.type_id" label="id типа"></Input>
                <GroupInputs label="Данные для заполнения">
                    <textarea v-model="objectData.data" class="cos-input"></textarea>
                </GroupInputs>
                <Button text="Сохранить" @b-click="addTemplate"></Button>
            </GroupInputs>
            <GroupInputs label="Важное">
                <Button type="error" text="Удалить" @b-click="deleteTemplate"></Button>
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
            this.$router.push(`/app/template`)
        },
        setAction() {
            this.action = this.$route.params.action
        },
        loadTemplate() {
            if (this.action == 'edit') {
                var url = `/api/sample/${this.$route.params.templateId}`
                this.axios.get(url).then(response => {
                    this.objectData = response.data
                    this.objectData.data = JSON.stringify(response.data.data)
                }).catch(error => { this.$noty.info('Неудалось получить шаблон'); });
            }
            else if (this.action == 'create') {
                console.log('create')
                this.objectData = {
                    name: '',
                    type_id: '',
                    data: ''
                }
            }
        },
        addTemplate() {
            if (this.action == 'create') {
                var url = '/api/sample/'
                this.axios.post(url, {
                    name: this.objectData.name,
                    type_id: this.objectData.type_id,
                    data: JSON.parse(this.objectData.data)
                }).then(response => {
                    console.log(response.data)
                    // this.onBack()
                }).catch(error => {
                    this.$noty.info('Не удалось создать шаблон');
                });
            }
            else if (this.action == 'edit') {
                var url = `/api/sample/${this.$route.params.templateId}`
                this.axios.put(url, {
                    name: this.objectData.name,
                    type_id: this.objectData.type_id,
                    data: JSON.parse(this.objectData.data)
                }).then(response => {
                    this.onBack()
                }).catch(error => {
                    this.$noty.info('Не удалось отредактировать шаблон');
                });
            }
        },
        deleteTemplate() {
            var url = `/api/sample/${this.$route.params.templateId}`
            this.axios.delete(url).then(response => {
                this.onBack()
            }).catch(error => { this.$noty.info('Неудалось удалить шаблон'); });
        },

    },
    computed: {
        nameActivity() {
            if (this.action == 'create') {
                return 'Создание шаблона'
            }
            else if (this.action == 'edit') {
                return 'Редактирование шаблона'
            }
        },
    },
    created() {
        this.setAction()
        this.loadTemplate()
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