<template>
    <div class="you-nav-elem">
        <div class="you-state-layer">
            <p class="you-title-medium">
                {{ text }}
            </p>
        </div>
    </div>
</template>

<script>

export default {
    props: {
        text: {
            type: String,
            default: 'button'
        },
        withIcon: {
            type: Boolean,
            default: false
        },
        icon: {
            type: String,
            default: ""
        },
        round: {
            type: Boolean,
            default: true
        },
        type: {
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
        initData() {
            // console.log(this.text)
        }
    },
    mounted() {
    }
}
</script>

<style>
.you-nav-elem {
    user-select: none;
    cursor: pointer;
    background: var(--primary-container);
    color: var(--on-primary-container);
    border-radius: 100px;
    overflow: hidden;
}

.you-nav-elem>.you-state-layer {
    display: flex;
    flex-direction: row;
    align-items: flex-start;
    padding: 16px 24px 16px 16px;
    gap: 12px;
}

.you-button>.you-state-layer:hover {
    background: var(--opacity-25);
}
</style>