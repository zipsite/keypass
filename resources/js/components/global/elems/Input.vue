<template>
    <div :class="youInputStyle">
        <div class="label">
            <p class="you-label-small">{{ label }}</p>
        </div>
        <div class="content">
            <input class="text-place you-body-large" :type="type" :value="value" @input="$emit('input', $event.target.value)"
                @focus="onFocus(true)" @blur="onFocus(false)">
        </div>
        <div v-show="supportText != ''" class="support">
            <p class="you-body-small">{{ supportText }}</p>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        value: {
            default: ""
        },
        supportText: {
            type: String,
            default: ""
        },
        label: {
            type: String,
            default: "Label"
        },
        type: {
            type: String,
            default: "text"
        }

    },
    data() {
        return {
            state: "blur"
        }
    },
    methods: {
        onFocus(e) {
            if (e) {
                this.state = "focus"
            }
            else {
                this.state = "blur"
            }
        }
    },
    computed: {
        youInputStyle() {
            if (this.state == "blur") {
                return "you-input blur"
            }
            else if (this.state == "focus") {
                return "you-input focus"
            }
        }
    }
}
</script>

<style>
.you-input {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    width: 280px;
}

.you-input>.label {
    display: flex;
    padding: 4px 8px;
    align-self: stretch;
    color: var(--on-primary-container);
}

.you-input.focus>.label {
    color: var(--primary);
}

.you-input>.content {
    display: flex;
    background: var(--surface);
    border-bottom: 1px solid var(--on-primary-container);
    border-radius: 4px 4px 0px 0px;
    align-self: stretch;
}

.you-input.focus>.content {
    border-bottom: 1px solid var(--primary);
}


.you-input>.content>.text-place {
    color: var(--on-primary-container);
    padding: 8px 16px;
    flex-grow: 1;
}

.you-input input {
    background-color: transparent;
    border: none;
}

.you-input input:focus-visible {
    outline: none;
}

.you-input>.support {
    display: flex;
    padding: 3px 5px;
    align-self: stretch;
    color: var(--error);
}
</style>