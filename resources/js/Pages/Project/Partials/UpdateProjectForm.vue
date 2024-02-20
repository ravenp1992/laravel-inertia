<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Modal from "@/Components/Modal.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm } from "@inertiajs/vue3";

let props = defineProps({
    modelValue: Object | null,
});

let emit = defineEmits(["toggle:modelValue"]);

const form = useForm({
    name: props.modelValue.name,
    description: props.modelValue.description,
});

const submit = () => {
    form.patch(route("projects.update", props.modelValue), {
        onSuccess: () => {
            emit("toggle:modelValue", null);
        },
    });
};
</script>

<template>
    <section class="space-y-6">
        <Modal
            :show="modelValue != null"
            closeable
            @close="emit('toggle:modelValue', null)"
        >
            <div class="p-6">
                <div class="mt-6">
                    <form @submit.prevent="submit" class="mt-6 space-y-6">
                        <div>
                            <InputLabel for="name" value="Name" />
                            <TextInput v-model="form.name" required autofocus />
                        </div>
                        <div>
                            <InputLabel for="description" value="Description" />
                            <TextInput v-model="form.description" />
                        </div>
                        <button
                            type="submit"
                            class="py-2 px-4 bg-blue-400 text-white hover:bg-blue-500"
                        >
                            Update
                        </button>
                    </form>
                </div>
            </div>
        </Modal>
    </section>
</template>
