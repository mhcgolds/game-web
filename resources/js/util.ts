import { usePage } from '@inertiajs/vue3';

export function getModel(name: string) {
    return usePage().props[name];
}