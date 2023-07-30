<script setup lang="ts">
import { ref } from 'vue';

defineProps<{
    modelValue: number
}>();

const input = ref<HTMLInputElement | null>(null);
</script>

<template>
    <input
        type="hidden"
        name="id"
        :value="modelValue"
        ref="input"
    />
</template>
