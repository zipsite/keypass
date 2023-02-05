<template>
    <button class="you-icon-button" @click="$emit('b-i-click', idData)">
        <div class="you-state-layer">
            <span class="icon-24">{{ icon }}</span>
        </div>
    </button>
</template>

<script>
export default {
    props: {
        idData: {
            type: Object
        },
        icon: {
            type: String,
            default: ""
        },
    },
    methods: {
    },
    computed: {
    },
}
</script>

<style>
.you-icon-button {
    border: none;
    background:none;
    user-select: none;
    cursor: pointer;
    color: var(--on-primary-container);
    border-radius: 100px;
    overflow: hidden;
}

.you-icon-button > div {
    display: flex;
    align-items: flex-start;
    padding: 8px;
}

.you-icon-button>.you-state-layer:hover {
    background: var(--opacity-25);
}
</style>