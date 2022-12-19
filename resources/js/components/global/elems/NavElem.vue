<template>
    <div class="you-nav-elem" @click="$emit('nav-elem', id)">
        <div class="you-state-layer">
            <span class="icon-24">{{ icon }}</span>
            <p class="you-title-medium">
                {{ text }}
            </p>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        id: {
            type: Number
        },
        text: {
            type: String,
            default: 'button'
        },
        icon: {
            type: String,
            default: ""
        },
        active: {
            type: Boolean,
            default: false
        }
    },
    data() {
        return {
            state: "enable",
        }
    },
    methods: {
        
    },
    computed: {
    //     isActive() {
    //         if (this.active === true) {
    //             return 'you-nav-elem active'
    //         }
    //         else{
    //             return 'you-nav-elem'
    //         }
    //     }
    },
    mounted() {
    }
}
</script>

<style>
.you-nav-elem {
    user-select: none;
    cursor: pointer;
    color: var(--on-primary-container);
    border-radius: 100px;
    overflow: hidden;
}

/* .you-nav-elem.active {
    background: var(--primary-container);
} */

.you-nav-elem > div {
    display: flex;
    flex-direction: row;
    align-items: flex-start;
    padding: 16px 24px 16px 16px;
    gap: 12px;
}

.you-nav-elem>.you-state-layer:hover {
    background: var(--opacity-25);
}
</style>