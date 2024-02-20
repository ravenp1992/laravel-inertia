<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

defineProps({
    project: {
        type: Object,
        default: null,
    },
});
</script>

<template>
    <Head title="Projects" />

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="font-semibold capitalize text-xl text-gray-800 leading-tight"
            >
                {{ project.name }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div>
                        <div class="flex justify-between items-center">
                            <h3>Members</h3>

                            <button
                                class="bg-blue-500 rounded text-white py-2 px-4 uppercase text-sm"
                            >
                                Create
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div>
                        <div class="flex justify-between items-center">
                            <h3>Tickets</h3>

                            <button
                                class="bg-blue-500 rounded text-white py-2 px-4 uppercase text-sm"
                            >
                                Create
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
