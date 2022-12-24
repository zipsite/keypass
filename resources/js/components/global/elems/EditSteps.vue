<template>
    <GroupInputs label="Шаги">
        <Input v-model="selectStepsIndex" label="Шаг"></Input>
        <Button @b-click="addStep" text="Добавить"></Button>
        <template>
        </template>
    </GroupInputs>
</template>

<script>
export default {
    props: {
        item: Array,
        value: Array
    },
    data() {
        return {
            selectStepsIndex: 0
        }
    },
    methods: {
        addStep() {
            this.$emit('input', this.item[this.selectStepsIndex])
        },
    }
}
</script>