<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Sidebar from '@/Components/Sidebar.vue';
import Card from '@/Components/Card.vue';
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Dashboard
            </h2>
        </template>
        <div class="py-12">
            <div class="w-fit mx-auto sm:px-6 lg:px-8">
                <div class="w-fit bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <div class="col-span-4  grid grid-cols-3 gap-4">
                        <Card>
                            <template #Card-content>
                                GG
                            </template>
                        </Card>
                        <Card> <template #Card-content>
                                GG
                            </template></Card>
                        <Card> <template #Card-content>
                                GG
                            </template></Card>
                        <Card> <template #Card-content>
                                GG
                            </template></Card>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
