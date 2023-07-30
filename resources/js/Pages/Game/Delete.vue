<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import HiddenIdInput from '@/Components/HiddenIdInput.vue';
import type { PropType } from 'vue'
import Game from '@/types';

defineProps({ game: Object as PropType<typeof Game> });

const model = usePage().props.game as typeof Game;

const form = useForm({
    id: model.id,
    title: model.title
});
</script>
<template>
    <Head title="Game" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Delete Game "{{ game.title }}"</h2>
        </template>

        <form @submit.prevent="form.delete(route('game.destroy'))" class="mt-6 space-y-6">
            <p>Delete game "{{ game.title }}" ?</p>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Delete</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Deleted.</p>
                </Transition>
            </div>

            <HiddenIdInput v-model="game.id"></HiddenIdInput>
        </form>
    </AuthenticatedLayout>
</template>
