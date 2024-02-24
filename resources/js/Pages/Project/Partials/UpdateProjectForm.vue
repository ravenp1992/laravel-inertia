<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import Modal from "@/Components/Modal.vue";
import TextInput from "@/Components/TextInput.vue";
import { useForm } from "@inertiajs/vue3";

const toggle = defineModel("toggle");
const project = defineModel("project");

const form = useForm({
    name: project.value.name,
    description: project.value.description,
});

const submit = () => {
    form.patch(route("projects.update", project.value.id), {
        onSuccess: () => {
            close();
        },
    });
};

const close = () => {
    toggle.value = !toggle.value;
    project.value = null;
};
</script>

<template>
    <section class="space-y-6">
        <Modal :show="toggle" closeable @close="close">
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
