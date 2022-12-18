<template>
    <div class="you-button" >
        <div class="you-state-layer">
            <p class="you-title-small">
                {{ text }}
            </p>
        </div>
    </div>
</template>

<script>

export default {
    props: {
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
        initData() {
            // console.log(this.text)
        }
    },
    mounted() {
    }
}
</script>

<style>
.you-button {
    user-select: none;
    cursor: pointer;
    background: var(--primary-container);
    color: var(--on-primary-container);
    border-radius: 100px;
    overflow: hidden;
}

.you-button>.you-state-layer {
    display: flex;
    flex-direction: row;
    justify-content: center;
    align-items: center;
    padding: 10px 24px;
}

.you-button>.you-state-layer:hover {
    background: var(--opacity-25);
}
</style>