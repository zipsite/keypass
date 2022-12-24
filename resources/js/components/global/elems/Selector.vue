<template>
    <div :class="youSelectStyle" @click="onActiveSwitch">
        <div class="label">
            <p class="you-label-small">{{ label }}</p>
        </div>
        <div class="content">
            <div class="text-place" >
                <p class="you-body-large">{{ variants[value].name }}</p>
            </div>
            <div class="icon-place">
                <span class="icon-24">arrow_drop_down</span>
            </div>
        </div>
        <div class="list-elem">
            <SelectorListElem 
            v-for="(elem, index) in variants"
            :key="index"
            :idData="{id: index}"
            :text="elem.name"
            :active="index == value ? true : false"
            @l-e-click="$emit('input', index)"
            @click="onActiveSwitch"
            ></SelectorListElem>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        value: {
            type: Number,
            default: 0,
        },
        label: {
            type: String,
            default: "Label"
        },
        variants: {
            type: Array,
            default: [{id: 1, name: ''}]
        }
    },
    data() {
        return {
            active: false,
        }
    },
    methods: {
        onActiveSwitch() {
            this.active = this.active === true ? false : true
        },
    },
    create() {
    },
    computed: {
        youSelectStyle() {
            if (this.active === false) {
                return "you-select blur"
            }
            else if (this.active === true) {
                return "you-select focus"
            }
        }
    }
}
</script>

<style>
.you-select {
    user-select: none;
    cursor: pointer;
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    width: 280px;
}

.you-select>.list-elem {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    padding: 0px 0px;
    height: 0px;
    position: absolute;
    right: 0px;
    left: 0px;
    top: 78px;
    background-color: var(--surface);
    transition-timing-function: cubic-bezier(0.075, 0.82, 0.165, 1);
    transition-duration: 200ms;
    transition-property: all;
    border-radius: 4px;
    z-index: 5;
}

.you-select.focus>.list-elem {
    height: auto;
    padding: 8px 0px;
    box-shadow: var(--elevate);
}

.you-select>.label {
    display: flex;
    padding: 4px 8px;
    align-self: stretch;
    color: var(--on-primary-container);
}

.you-select.focus>.label {
    color: var(--primary);
}

.you-select>.content {
    display: flex;
    background: var(--surface);
    border-bottom: 1px solid var(--on-primary-container);
    border-radius: 4px 4px 0px 0px;
    align-self: stretch;
}

.you-select.focus>.content {
    border-bottom: 1px solid var(--primary);
}


.you-select>.content>.text-place {
    color: var(--on-primary-container);
    padding: 8px 16px;
    flex-grow: 1;
}

.you-select>.content>.icon-place {
    display: flex;
    align-items: flex-start;
    padding: 8px;
}

.you-select.focus>.content>.icon-place {
    transform: rotate(180deg);
}
</style>