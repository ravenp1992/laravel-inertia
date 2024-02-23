<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";

const props = defineProps({
    projects: {
        type: Array,
        default: [],
    },
});
</script>

<template>
    <AppLayout>
        <div class="flex justify-between text-gray-500">
            <h2 class="text-sm font-semibold text-gray-700">Tickets</h2>

            <div class="text-xs">
                <span class="font-semibold text-gray-700">Filters:</span>
                <select
                    class="border-none focus:outline-none focus:border-none focus:ring-0 bg-transparent outline-none text-xs"
                    name=""
                    id=""
                >
                    <option value="">Status</option>
                </select>
            </div>
        </div>
    </AppLayout>
</template>
