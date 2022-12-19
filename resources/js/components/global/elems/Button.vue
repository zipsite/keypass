<template>
    <div :class="buttonStyle" @click="$emit('b-click', idData)">
        <div class="you-state-layer">
            <span v-show="withIcon" class="icon-18">{{ icon }}</span>
            <p class="you-title-small">
                {{ text }}
            </p>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        idData: {
            type: Object
        },
        text:{
            type: String,
            default: 'button'
        },
        withIcon:{
            type: Boolean,
            default: false
        },
        icon:{
            type: String,
            default: ""
        },
        round:{
            type: Boolean,
            default: true
        },
        type:{
            type: String,
            default: "tone"
        },
    },
    data() {
        return {
            state: "enable",
        }
    },
    methods: {
    },
    computed: {
        buttonStyle() {
            let result = "you-button"
            if (this.round == true) {
                result += " round"
            }
            else if (this.round == false) {
                result += " squire"
            }

            if (this.withIcon == true) {
                result += " icon"
            }

            if (this.type == "tone") {
                result += " tone"
            }
            else if (this.type == "text") {
                result += " text"
            }
            else if (this.type == "error") {
                result += " error"
            }
            return result
        }
    }
}
</script>

<style>
.you-button {
    user-select: none;
    cursor: pointer;
    overflow: hidden;
}
.you-button>.you-state-layer {
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
}


.you-button.tone {
    background: var(--primary-container);
    color: var(--on-primary-container);
}
.you-button.text {
    color: var(--on-primary-container);
}
.you-button.error {
    background: var(--error);
    color: var(--on-error);
}

.you-button.round {
    border-radius: 100px;
}
.you-button.squire {
    border-radius: 4px;
}


.you-button.icon>.you-state-layer {
    padding: 10px 24px 10px 12px;
    gap: 10px;
}
.you-button>.you-state-layer {
    padding: 10px 24px;
}

.you-button:hover>.you-state-layer {
    background: var(--opacity-25);
}

</style>