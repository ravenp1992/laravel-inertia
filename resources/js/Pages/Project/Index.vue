<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import ProjectTicketCard from "./Components/ProjectTicketCard.vue";
import { ref, watch, computed } from "vue";

const props = defineProps({
    projects: {
        type: Array,
        default: [],
    },
});

const project = ref("");
const search = ref();

const tickets = ref([]);

const filteredTickets = computed(() => {
    return search.value && tickets.value
        ? tickets.value.filter((t) =>
              t.title.toLowerCase().includes(search.value.toLowerCase()),
          )
        : tickets.value;
});

const backlogTickets = computed(() => {
    return filteredTickets.value.filter((t) => t.status === "backlog");
});

const inProgressTickets = computed(() => {
    return filteredTickets.value.filter((t) => t.status === "inprogress");
});

const completedTickets = computed(() => {
    return filteredTickets.value.filter((t) => t.status === "complete");
});

watch(project, (newValue, oldValue) => {
    tickets.value = project.value
        ? (tickets.value = props.projects.find((p) => p.id === newValue.id))
              .tickets
        : [];
});
</script>

<template>
    <AppLayout v-model:project="project" v-model:search="search">
        <div v-if="project" class="flex my-4 justify-between text-gray-500">
            <h2 class="text-sm font-semibold text-gray-700">Tickets</h2>

            <!-- <div class="text-xs"> -->
            <!--     <span class="font-semibold text-gray-700">Filters:</span> -->
            <!--     <select -->
            <!--         class="border-none focus:outline-none focus:border-none focus:ring-0 bg-transparent outline-none text-xs" -->
            <!--         name="" -->
            <!--         id="" -->
            <!--     > -->
            <!--         <option value="">Status</option> -->
            <!--     </select> -->
            <!-- </div> -->
        </div>
        <div class="grid grid-cols-3 gap-5">
            <div class="border-4 border-dashed h-full p-4">
                <h2
                    class="text-sm uppercase text-center font-bold tracking-wide"
                >
                    Backlogs
                </h2>
                <div v-if="backlogTickets.length" class="mt-8 flex flex-col">
                    <ProjectTicketCard
                        v-for="ticket of backlogTickets"
                        :ticket="ticket"
                        :key="ticket"
                    />
                </div>
            </div>
            <div class="border-4 border-dashed h-full p-4">
                <h2
                    class="text-sm uppercase text-center font-bold tracking-wide"
                >
                    In Progress
                </h2>
                <div v-if="inProgressTickets.length" class="mt-8 flex flex-col">
                    <ProjectTicketCard
                        v-for="ticket of inProgressTickets"
                        :ticket="ticket"
                        :key="ticket"
                    />
                </div>
            </div>
            <div class="border-4 border-dashed h-full p-4">
                <h2
                    class="text-sm uppercase text-center font-bold tracking-wide"
                >
                    Completed
                </h2>
                <div v-if="completedTickets.length" class="mt-8 flex flex-col">
                    <ProjectTicketCard
                        v-for="ticket of completedTickets"
                        :ticket="ticket"
                        :key="ticket"
                    />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
