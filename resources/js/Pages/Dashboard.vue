<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
defineProps({ categories: Object, products: Object,ProductCount:Number })

</script>
<template>
    <AppLayout title="Dashboard">
        <div class="dark:bg-gray-800 dark:text-white text-gray-700 text-3xl my-3 sm:rounded-lg">
                <div class="px-6 py-3">
                    Dashboard
                </div>
            </div>
                <div class="grid grid-cols-3 gap-4 mb-4">
                    <div class="flex items-center justify-start h-24 sm:rounded-lg bg-white dark:bg-gray-800">
                        <div class="text-2xl text-gray-700 dark:text-white mx-2 px-6 py-3" >
                            Storages (Total: {{ ProductCount }})
                        </div>
                    </div>
                </div>
    </AppLayout>
</template>
