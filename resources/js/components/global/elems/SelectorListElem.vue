<template>
    <div :class="styleSelectElem" @click="$emit('l-e-click', idData)">
        <div class="state-layer">
            <p class="you-body-large">{{ text }}</p>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        idData: {
            type: Object
        },
        text: {
            type: String,
            default: 'text'
        },
        active: {
            type: Boolean,
            default: false,
        }
    },
    computed: {
        styleSelectElem() {
            if (this.active === true) {
                return 'you-select-elem active'
            }
            else {
                return 'you-select-elem'
            }
        }
    }
}
</script>
<style>
.you-select-elem {
    user-select: none;
    cursor: pointer;
    overflow: hidden;
    align-self: stretch;
}
.you-select-elem.active {
    background: var(--primary-container);
}

.you-select-elem>.state-layer {
    display: flex;
    flex-direction: row;
    align-items: flex-start;
    padding: 8px 16px;
    
}

.you-select-elem:hover>.state-layer {
    background-color: var(--opacity-25);
}
</style>