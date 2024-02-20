<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import NavLink from "@/Components/NavLink.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextArea from "@/Components/TextArea.vue";
import { ref } from "vue";

let props = defineProps({
    modelValue: Boolean,
});

let emit = defineEmits(["toggle:modelValue"]);

const form = useForm({
    name: "",
    description: "",
});

function submit() {
    form.post(route("projects.store"), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
            emit("toggle:modelValue", !props.modelValue);
        },
    });
}
</script>

<template>
    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="flex justify-between items-center">
            <h3>Create new Project For</h3>

            <button
                @click="emit('toggle:modelValue', !modelValue)"
                class="hover:text-gray-900 text-gray-500 text-sm"
            >
                X
            </button>
        </div>

        <!-- Refactor -> move to its own component -->
        <form @submit.prevent="submit">
            <div class="mt-4">
                <InputLabel for="name" value="Title" />
                <TextInput
                    id="name"
                    type="text"
                    v-model="form.name"
                    autofocus
                />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>
            <div class="mt-4">
                <InputLabel for="descriptiton" value="Description" />
                <TextArea
                    id="description"
                    v-model="form.description"
                ></TextArea>
            </div>
            <button
                class="bg-blue-400 mt-4 text-white hover:bg-blue-500 px-4 py-2 disable:bg-gray-100 disable:text-gray-500"
                type="submit"
                :disabled="form.processing"
            >
                Submit
            </button>
        </form>
    </div>
</template>
