<script setup>
import {computed} from 'vue'

const STATUS_PENDING = 'pending';
const STATUS_APPROVED = 'approved';
const STATUS_REJECTED = 'rejected';

const props = defineProps({
    status: {
        type: String,
    },
});

const statusClass = computed(() => {
    switch (props.status) {
        case STATUS_APPROVED: return 'bg-green-500';
        case STATUS_REJECTED: return 'bg-red-500';
        case STATUS_PENDING:
        default: return 'bg-orange-500';
    }
})
</script>

<template>
    <span class="px-2 py-1 text-sm font-semibold text-white rounded-md" :class="statusClass">
        {{ status }}
    </span>
</template>
