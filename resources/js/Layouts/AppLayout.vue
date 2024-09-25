<script setup>
import { ref } from 'vue';
import { Head, Link, router } from '@inertiajs/vue3';
import ApplicationMark from '@/Components/ApplicationMark.vue';
import Banner from '@/Components/Banner.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import Themeswitcher from '@/Components/ThemeSwitcher.vue';
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

        <Head :title="title">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        </Head>

        <Sidebar></Sidebar>
        <!-- Page Heading -->
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
