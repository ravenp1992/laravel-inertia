<script setup>
import { Link } from "@inertiajs/vue3";

const project = defineModel("project");
const search = defineModel("search");
</script>
<template>
    <div class="flex text-gray-700">
        <div class="bg-white">
            <nav
                class="flex justify-start flex-col items-center bg-gray-900 min-h-full"
            >
                <Link
                    :class="{
                        'p-4': true,
                        'text-white': route().current('dashboard'),
                        'text-gray-500': !route().current('dashboard'),
                    }"
                    :href="route('dashboard')"
                >
                    <v-icon class="h-6 w-6" name="fa-tachometer-alt"></v-icon>
                </Link>
                <Link
                    :href="route('projects.index')"
                    :class="{
                        'p-4': true,
                        'text-white': route().current('projects.index'),
                        'text-gray-500': !route().current('projects.index'),
                    }"
                >
                    <v-icon class="h-6 w-6" name="fa-tasks"></v-icon>
                </Link>
            </nav>
        </div>
        <div class="flex-1">
            <div
                class="flex space-x-4 divide-x py-1.5 px-4 border items-center border-b-gray-100"
            >
                <div class="min-w-40">
                    <h1 class="text-sm font-bold capitalize">
                        {{ $page.props.auth.user.name }}
                    </h1>
                    <p class="text-xs font-semibold">
                        <span class="text-gray-500"
                            >Developer:

                            <span>Software Developer</span>
                        </span>
                    </p>
                </div>
                <div class="flex justify-between items-center flex-1">
                    <div>
                        <!-- Need to create a reusable select component -->
                        <select
                            class="text-xs border-none outline-none focus:border-none focus:outline-none focus:ring-0"
                            v-model="project"
                        >
                            <option value="">Select Project</option>
                            <option
                                v-for="project of $page.props.auth.user
                                    .projects"
                                :key="project.id"
                                :value="project"
                            >
                                {{ project.name }}
                            </option>
                        </select>
                    </div>
                    <div class="space-x-4">
                        <input
                            class="text-xs focus:outline-none focus:ring-0 focus:border-b focus:border-gray-700 border-none outline-none"
                            type="search"
                            placeholder="Search Tasks"
                            v-model="search"
                        />
                        <button class="group">
                            <v-icon
                                class="h-4 w-4 text-gray-500 group-hover:text-gray-700"
                                name="fa-cog"
                            />
                        </button>
                    </div>
                </div>
            </div>

            <main class="px-4 py-2 bg-gray-50 min-h-screen">
                <slot></slot>
            </main>
        </div>
    </div>
</template>
