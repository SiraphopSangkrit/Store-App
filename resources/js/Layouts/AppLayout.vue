<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import Sidebar from '@/Components/Sidebar.vue';

defineProps({
    title: String,
});
const showingNavigationDropdown = ref(false);
const switchToTeam = (team) => {
    router.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};
const logout = () => {
    router.post(route('logout'));
};
</script>
<template>
    <div>
        <Head :title="title"/>
        <Sidebar></Sidebar>
        <!-- Page Content -->
        <main class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            </div>
            <div class="p-4 sm:ml-64">
                <slot />
            </div>
        </main>
    </div>

</template>
