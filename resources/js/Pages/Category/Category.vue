<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import Modal from '@/Components/Modal.vue';
import ActionMessage from '@/Components/ActionMessage.vue';
import { reactive, ref } from 'vue'
import { router } from '@inertiajs/vue3'

const form = reactive({
    cname: '',
});


function submit() {
    router.post(route('category.store'), form, {
        onSuccess: () => {
            handleClose();
            handleSubmit();
            successMessage.value = 'Category created successfully!';
            showMessage.value = true;
            form.cname = ''; // Clear the form
        },
    });
}
function CategoryDelete(categoryId) {
    router.delete(route('category.destroy', categoryId), {
        onSuccess: () => {
            handleSubmit();
            handleClose();
            successMessage.value = 'Category deleted successfully!';
            showMessage.value = true;
        },
    });
}

const showConfirmDeleteModal = ref(false);

const showMessage = ref(false);

const successMessage = ref('');

const showModal = ref(false);

const handleClose = () => {
    showModal.value = false;
    showConfirmDeleteModal.value = false;
};
const handleSubmit = () => {
    console.log('Form submitted:');
    setTimeout(() => {
        showMessage.value = false;
    }, 3000);
};
defineProps({ categories: Object })
</script>
<template>
    <AppLayout title="Category">
        <ActionMessage :on="showMessage">
            <div v-if="successMessage"
                class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <span class="font-medium">{{ successMessage }}</span>
            </div>
        </ActionMessage>
        <div
            class="flex justify-between dark:bg-gray-800 dark:text-white text-gray-700 text-3xl sm:rounded-lg my-3 bg-white">
            <div class="px-6 py-3">
                Category
            </div>
            <button @click="showModal = true"
                class="m-1 block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">
                Create Category
            </button>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Category name
                        </th>
                        <th scope="col" class="px-6 py-3 flex justify-center items-center">
                            Action
                        </th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="category in categories" :key="category.id"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ category.title }}
                        </th>
                        <td class="px-6 py-4 flex justify-center items-center">
                            <button type="button" @click="showConfirmDeleteModal = true"
                                class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</button>
                        </td>
                        <Modal :show="showConfirmDeleteModal" @close="handleClose" maxWidth="lg" closeable>
                            <template #default>
                            <div
                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    Confirm delete category?
                                </h3>
                            </div>
                                <div class="p-4 md:p-5 flex items-center justify-center">
                                    <div class="space-y-4">
                                            <button type="button" @click="CategoryDelete(category.id)"
                                                class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</button>
                                                <button type="button" @click="showConfirmDeleteModal= false"
                                                class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-950 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Cancel</button>
                                    </div>
                                </div>
                        </template>
                        </Modal>
                    </tr>

                </tbody>
            </table>
        </div>
        <Modal :show="showModal" @close="handleClose" maxWidth="lg" closeable>

            <template #default>
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Create Category
                    </h3>
                    <button type="button" @click="showModal = false"
                        class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close</span>
                    </button>
                </div>
                <div class="p-4 md:p-5">
                    <form @submit.prevent="submit" class="space-y-4">
                        <div>
                            <label for="category"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category
                                Name</label>
                            <input type="text" name="cname" id="cname" v-model="form.cname"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="Category Name" required />
                        </div>
                        <button type="submit" :disabled="form.processing"
                            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create
                            Category</button>
                    </form>
                </div>
            </template>
        </Modal>
    </AppLayout>
</template>
