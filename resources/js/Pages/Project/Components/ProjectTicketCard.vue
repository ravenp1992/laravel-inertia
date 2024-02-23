<script setup>
defineProps({
    ticket: {
        type: Object,
    },
});
</script>

<template>
    <div class="py-2 border-b border-gray-500">
        <h3 class="text-sm font-bold">{{ ticket.title }}</h3>
        <p class="text-xs mt-1">{{ ticket.description }}</p>

        <div class="flex justify-between mt-4">
            <div>
                <button class="group" v-if="ticket.notes.length">
                    <v-icon
                        :class="{
                            'text-blue-500': ticket.notes.length != 0,
                        }"
                        name="fa-sticky-note"
                    />
                </button>
            </div>
            <select class="text-xs border-none focus:border-none focus:ring-0">
                <option value="inprogress">In Progress</option>
                <option value="completed">Complete</option>
            </select>
        </div>
    </div>
</template>
