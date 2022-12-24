<template>
    <div class="group-inputs">
        <div class="label">
            <p class="you-title-medium">
                {{ label }}
            </p>
        </div>
        <div class="content">
            <template v-for="(elem, index) in item">
                <Input v-if="elem.type == 'string' || elem.type == 'ifstring' || elem.type == 'enum'"
                    v-model="value[elem.name]" :label="elem.name"></Input>
                <EachGroupInputs
                    v-else-if="initDataObject(elem.type == 'object', elem, value, {})"
                    @input="value[elem.name] = $event"
                    :value="value[elem.name]"
                    :item="elem.contained"
                    :label="elem.name">
                </EachGroupInputs>
                <EditSteps
                    v-else-if="initDataObject(elem.type == 'array', elem, value, [])"
                    @input="value[elem.name] = $event"
                    :value="value[elem.name]"
                    :item="elem.variant"
                ></EditSteps>
            </template>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        item: {
            type: Array
        },
        value: {

        },
        label: {
            type: String,
            default: ""
        }
    },
    data() {
        return {
            check: ""
        }
    },
    methods: {
        initDataObject(condition, elem, value, input) {
            if (!(Object.hasOwn(value, elem.name))) {
                this.$emit('input', {key: elem.name, value: input})
            }
            return condition
        }
    }

}
</script>

<style>
.group-inputs {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    align-self: stretch;
}

.group-inputs>.label {
    display: flex;
    padding: 4px 8px;
    align-self: stretch;
    color: var(--on-primary-container);
}

.group-inputs>.content {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    padding: 12px 16px;
    gap: 12px;
    border-left: 4px solid var(--primary);
    align-self: stretch;
}
</style>