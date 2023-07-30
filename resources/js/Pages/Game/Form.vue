<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import HiddenIdInput from '@/Components/HiddenIdInput.vue';
import type { PropType } from 'vue'
import Game from '@/types';

defineProps({ game: Object as PropType<typeof Game> });

const model = usePage().props.game as typeof Game;

const form = useForm({
    id: model.id,
    title: model.title
});

function submit(e) {
    if (!e.target.id.value) {
        form.post(route('game.save'));
    }
    else {
        form.patch(route('game.update'));
    }
}
</script>
<template>
    <Head title="Game" />

    <AuthenticatedLayout>
        <template #header>
            <h2 v-if="game.id" class="font-semibold text-xl text-gray-800 leading-tight">Editing Game "{{ game.title }}"</h2>
            <h2 v-if="!game.id" class="font-semibold text-xl text-gray-800 leading-tight">Create New Game</h2>
        </template>

        <form @submit.prevent="submit" class="mt-6 space-y-6">
            <div>
                <InputLabel for="title" value="Title" />

                <TextInput
                    id="title"
                    name="title"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.title"
                    required
                    autofocus
                    autocomplete="title"
                />

                <InputError class="mt-2" :message="form.errors.title" />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>

            <HiddenIdInput v-model="game.id"></HiddenIdInput>
        </form>
    </AuthenticatedLayout>
</template>
