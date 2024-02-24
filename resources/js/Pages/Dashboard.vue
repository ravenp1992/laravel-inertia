<script setup>
import { Head } from "@inertiajs/vue3";
import { ref, computed } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import ProjectCard from "@/Pages/Project/Components/ProjectCard.vue";
import UpdateProjectForm from "@/Pages/Project/Partials/UpdateProjectForm.vue";
import CreateProjectForm from "@/Pages/Project/Partials/CreateProjectForm.vue";

const props = defineProps({
    projects: {
        type: Array,
        default: [],
    },
});

const search = ref("");

const project = ref(null);
const toggleEditModal = ref(false);
const toggleCreateModal = ref(false);

const filteredProjects = computed(() => {
    return search.value !== ""
        ? props.projects.filter((p) =>
              p.name.toLowerCase().includes(search.value.toLowerCase()),
          )
        : props.projects;
});

const toggleModalAndSetProject = (p) => {
    toggleEditModal.value = !toggleEditModal.value;
    project.value = p;
};
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout>
        <UpdateProjectForm
            v-model:toggle="toggleEditModal"
            v-model:project="project"
            v-if="project"
        />

        <CreateProjectForm v-model:toggle="toggleCreateModal" />

        <div class="flex my-4 justify-between text-gray-500">
            <div class="flex space-x-4 items-center">
                <h2 class="text-sm font-semibold text-gray-700">
                    Project List
                </h2>
                <button
                    class="bg-blue-400 flex space-x-2 items-center group-hover:bg-blue-500 text-xs uppercase px-2 py-1 text-white"
                    @click="toggleCreateModal = !toggleCreateModal"
                >
                    <v-icon class="h-3 w-3" name="fa-plus" />
                    <span>Create</span>
                </button>
            </div>
            <div>
                <input
                    class="text-xs border-none outline-none focus:ring-0"
                    type="search"
                    v-model="search"
                    placeholder="Search Project"
                />
            </div>
        </div>

        <div class="grid grid-cols-3 gap-5">
            <ProjectCard
                v-for="project of filteredProjects"
                :project="project"
                :key="project"
                @toggle="(p) => toggleModalAndSetProject(p)"
            />
        </div>
    </AppLayout>
</template>
