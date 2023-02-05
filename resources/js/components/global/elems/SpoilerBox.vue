<template>
    <div :class="youSpoilerBox">
        <div class="content" @click="onActiveSwitch">
            <div class="text-place">
                <p class="you-body-large">{{ name }}</p>
            </div>
            <div class="icon-place">
                <span class="icon-24">arrow_drop_down</span>
            </div>
        </div>
        <div class="spoiler-place">
            <div>
                <p class="you-body-large">{{ text }}</p>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        name: {
            type: String,
            default: "Spoiler"
        },
        text: {
            default: "" 
        }
    },
    data() {
        return {
            active: false
        }
    },
    methods: {
        onActiveSwitch() {
            this.active = this.active === true ? false : true
        },
    },
    computed: {
        youSpoilerBox() {
            if (this.active === false) {
                return "you-spoiler-box blur"
            }
            else if (this.active === true) {
                return "you-spoiler-box focus"
            }
        }
    }
}
</script>

<style>
.you-spoiler-box {
    user-select: none;
    cursor: pointer;
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    background-color: var(--surface);
    border-radius: 4px;
    align-self: stretch;
}

.you-spoiler-box>.content {
    display: flex;
    align-self: stretch;
}

.you-spoiler-box>.content>.text-place {
    color: var(--on-primary-container);
    padding: 8px 16px;
    flex-grow: 1;
}

.you-spoiler-box>.content>.icon-place {
    padding: 8px;
}

.you-spoiler-box.blur>.spoiler-place{
    display: none;
}

.you-spoiler-box>.spoiler-place {
    display: flex;
    padding: 6px;
    align-self: stretch;
}

.you-spoiler-box>.spoiler-place>div {
    background-color: var(--background);
    padding: 10px;
    border-radius: 4px;
    flex-grow: 1;
}
</style>