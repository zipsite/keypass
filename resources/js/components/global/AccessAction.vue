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
                <Selector v-model="selectTypeIndex" @input="loadAccessTypeTemplates" label="Выбор типа" :variants="types">
                </Selector>
                <Selector v-model="selectTemplateIndex" @input="setSampleId" label="Выбор шаблона"
                    :variants="templates"></Selector>
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
import { types } from 'util'

export default {
    data() {
        return {
            types: [{ id: 1, name: ' ' }],
            templates: [{ id: 1, name: ' ' }],

            selectTypeIndex: 0,
            selectTemplateIndex: 0,

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
        loadAccessType() {
            var url = `/api/type/`
            this.axios.get(url).then(response => {
                this.types = response.data
            }).catch(error => { this.$noty.info('Неудалось получить типы'); });
        },
        loadAccessTypeTemplates() {
            var url = `/api/type/${this.types[this.selectTypeIndex].id}/sample`
            this.axios.get(url).then(response => {
                this.templates = response.data
            }).catch(error => { this.$noty.info('Неудалось получить шаблоны'); });
        },
                
        setParams(sample) {
            var url = `/api/sample/${sample}`
            this.axios.get(url).then(response => {
                for (let i = 0; i < this.types.length; i++) {
                    if (this.types[i].id == response.data.type_id) {

                        this.selectTypeIndex = i;

                        var url = `/api/type/${this.types[this.selectTypeIndex].id}/sample`
                        this.axios.get(url).then(response => {
                            this.templates = response.data
                            for (let i = 0; i < this.templates.length; i++) {
                                if (this.templates[i].id == this.objectData.sample_id) {
                                    console.log(i)
                                    this.selectTemplateIndex = i;
                                }
                            }
                        }).catch(error => { this.$noty.info('Неудалось получить шаблоны'); });
                    }
                }
            }).catch(error => { this.$noty.info('Неудалось получить шаблоны'); });
        },
        setSampleId() {
            this.objectData.sample_id = this.templates[this.selectTemplateIndex].id;
        },
        loadAccess() {
            if (this.action == 'edit') {
                var url = `/api/client/${this.$route.params.clientId}/access/${this.$route.params.accessId}`
                this.axios.get(url).then(response => {
                    this.objectData = response.data
                    this.objectData.data = JSON.stringify(response.data.data)
                    this.setParams(this.objectData.sample_id)
                }).catch(error => { this.$noty.info('Неудалось получить доступ'); });
            }
            else if (this.action == 'create') {
                console.log('create')
                this.objectData = {
                    name: '',
                    client_id: this.$route.params.clientId,
                    sample_id: 0,
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
        this.loadAccessType()
        this.loadAccessTypeTemplates()
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