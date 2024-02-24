<script setup>
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    project: {
        type: Object,
    },
});

const emit = defineEmits(["toggle"]);

const deleteForm = useForm({});

const handleDelete = () => {
    if (confirm("Are you sure")) {
        deleteForm.delete(route("projects.destroy", props.project.id));
    }
};
</script>

<template>
    <div class="p-4 bg-white rounded">
        <h3 class="font-bold text-gray-700">{{ project.name }}</h3>
        <p class="text-sm text-gray-500 mt-2 min-h-24">
            {{ project.description }}
        </p>
        <div
            class="mt-2 flex items-end"
            :class="{
                'justify-end': !project.notes.length,
                'justify-between': project.notes.length,
            }"
        >
            <button v-if="project.notes.length">
                <v-icon
                    :class="{
                        'text-blue-500': project.notes.length,
                    }"
                    name="fa-sticky-note"
                />
            </button>
            <div>
                <div class="flex text-xs uppercase space-x-2">
                    <button
                        class="text-blue-400 hover:text-blue-500"
                        @click="emit('toggle', project)"
                    >
                        Edit
                    </button>
                    <button
                        class="text-red-400 hover:text-red-500"
                        @click="handleDelete"
                    >
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
