<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import HiddenIdInput from '@/Components/HiddenIdInput.vue';
import type { PropType } from 'vue'
import Game from '@/types';

defineProps({ game: Object as PropType<typeof Game>, diagram: Object });

const model = usePage().props.game as typeof Game;

console.log(model);

const form = useForm({
    id: model.id
});

// Diagram
import '@progress/kendo-ui/js/kendo.dataviz.diagram';
import '@progress/kendo-theme-default/dist/all.css';
import { Diagram } from '@progress/kendo-diagram-vue-wrapper';
import { HierarchicalDataSource } from '@progress/kendo-datasource-vue-wrapper';

const shapeDefaults = {
    width: 200,
    height: 40
};

const layout = {
    type: "tree",
    subtype: "down",
    horizontalSeparation: 30,
    verticalSeparation: 20
};

let diagram, diagramData = [];
const kendoWidgetReady = function (widget) {
    diagram = widget;

    if (model) {
        let connections = [];
        const data = JSON.parse(JSON.stringify(model));

        if (data.stages && data.stages.length) {
            data.stages.forEach(stage => {
                let shape = new kendo.dataviz.diagram.Shape({
                    id: stage.id,
                    content: {
                        text: stage.title
                    },
                    width: 200,
                    x: stage.x,
                    y: stage.y
                });

                widget.addShape(shape);
                addStage(shape);

                if (stage.actions && stage.actions.length) {
                    stage.actions.forEach(action => {
                        if (action.game_stage_id && action.game_stage_target_id) {
                            connections.push([action.game_stage_id, action.game_stage_target_id]);
                        }
                    });
                }
            });

            if (connections.length) {
                connections.forEach(connection => {
                    widget.addConnection(
                        new kendo.dataviz.diagram.Connection(
                            widget.getShapeById(connection[0]),
                            widget.getShapeById(connection[1]))
                    );

                    addConnectionToStage(connection[0], connection[1]);
                });
            }
        }

        console.log('diagramData', diagramData);
    }
};

const kendoSelect = function(e) {
    if (e.selected.length === 1) { // Handle single selection

    }
};

const addStage = function(shape) {
    diagramData.push({
        id: shape.id,
        title: shape.options.content.text ?? '',
        x: 0,
        y: 0,
        connections: []
    });
};

const addConnectionToStage = function(originShapeId, targetShapeId) {
    const originShape = diagramData.find(shape => shape.id === originShapeId);

    if (originShape) {
        originShape.connections.push(targetShapeId);
    }
};

const formSubmit = function() {
    diagramData;
    //form.post(route('game.stages'));
};
</script>
<template>
    <Head title="Game" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editing Stages for Game "{{ game.title }}"</h2>
        </template>

        <form @submit.prevent="formSubmit" class="mt-6 space-y-6">
            <HierarchicalDataSource ref="localDataSource"></HierarchicalDataSource>

            <Diagram ref="diagram1"
                :layout="layout"
                :data-source-ref="'localDataSource'"
                :shape-defaults="shapeDefaults"
                :editable-resize="false"
                :editable-remove="false"
                @kendowidgetready="kendoWidgetReady"
                @select="kendoSelect">
            </Diagram>

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
