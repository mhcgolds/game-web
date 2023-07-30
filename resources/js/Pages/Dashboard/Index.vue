<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import Game from '@/types';

defineProps({ games: Array<typeof Game>, game_count: Number })
</script>
<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        Meus jogos ({{ game_count }}) - <Link :href="route('game.create')">New</Link>

                        <hr/>
                        <ul>
                            <li v-for="game in games">{{ game.title }} -
                                <Link :href="route('game.edit', { id: game.id })">Edit</Link> -
                                <Link :href="route('game.manage', { id: game.id })">Stages</Link> -
                                <Link :href="route('game.delete', { id: game.id })">Delete</Link></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
