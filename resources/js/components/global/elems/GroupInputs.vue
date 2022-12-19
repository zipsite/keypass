<template>
    <div class="group-inputs">
        <div class="label">
            <p class="you-title-medium">
                {{ label }}
            </p>
        </div>
        <div class="content">
            <slot></slot>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        label: {
            type: String,
            default: ""
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