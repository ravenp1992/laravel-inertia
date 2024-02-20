<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import NavLink from "@/Components/NavLink.vue";
import CreateProjectForm from "./Partials/CreateProjectForm.vue";
import UpdateProjectForm from "./Partials/UpdateProjectForm.vue";
import { ref } from "vue";

defineProps({
    projects: {
        type: Array,
        default: [],
    },
});

let isCreating = ref(false);
let selectedProject = ref(null);

function toggleCreateForm() {
    isCreating.value = !isCreating.value;
}
</script>

<template>
    <Head title="Projects" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Projects
                </h2>

                <button
                    v-if="!isCreating"
                    @click="toggleCreateForm"
                    class="py-2 px-4 rounded text-sm uppercase bg-blue-400 hover:bg-blue-500 text-white"
                >
                    New Project
                </button>
            </div>
        </template>

        <div class="py-12" v-if="isCreating">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <CreateProjectForm
                    v-model="isCreating"
                    @toggle:modelValue="toggleCreateForm"
                />
            </div>
        </div>

        <div v-if="selectedProject">
            <UpdateProjectForm
                @toggle:model-value="(value) => (selectedProject = value)"
                :project="selectedProject"
                :key="selectedProject"
                v-model="selectedProject"
            />
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="grid grid-cols-4 gap-5">
                        <div
                            class="bg-gray-100 p-4 rounded-lg"
                            v-for="project of projects"
                            :key="project.id"
                        >
                            <div class="flex flex-col h-full">
                                <div class="flex justify-between items-center">
                                    <h3 class="text-xl capitalize">
                                        {{ project.name }}
                                    </h3>
                                    <button
                                        class="text-gray-500 text-xs hover:text-red-500"
                                    >
                                        X
                                    </button>
                                </div>

                                <p class="text-gray-500 my-4 flex-1">
                                    {{ project.description }}
                                </p>

                                <div class="flex justify-between">
                                    <button
                                        class="text-sm bg-gray-200 py-1 px-2 font-bold text-gray-500"
                                        @click="selectedProject = project"
                                    >
                                        Edit
                                    </button>
                                    <NavLink
                                        class="text-sm text-blue-400 hover:text-gray-500"
                                        :href="route('projects.show', project)"
                                    >
                                        Details
                                    </NavLink>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
