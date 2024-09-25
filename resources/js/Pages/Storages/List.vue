<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Modal from '@/Components/Modal.vue';
import { reactive, ref } from 'vue'
import { router } from '@inertiajs/vue3'
import ActionMessage from '@/Components/ActionMessage.vue';

const form = reactive({
    pname: '',
    pcolor: '',
    pprice: '',
    pimage: '',
    pqty: '',
    cid: '',
});

const showMessage = ref(false);

function submit() {
    router.post(route('storages.store'), form, {
        onSuccess: () => {
            handleClose();
            handleSubmit();
            form.pname = '';
            form.pcolor = '';
            form.pprice = '';
            form.pimage = '';
            form.pqty = '';
            form.cid = '';
        },
    });
}
const showModal = ref(false);
const handleClose = () => {
    showModal.value = false;
};

const handleSubmit = () => {
    console.log('Form submitted:');
    showMessage.value = true;
    // Hide the message after 3 seconds
    setTimeout(() => {
        showMessage.value = false;
    }, 3000);
};

defineProps({ categories: Object ,products:Object})
</script>
<template>
    <AppLayout title="Storages">
        <div
            class="flex justify-between dark:bg-gray-800 dark:text-white text-gray-700 text-3xl sm:rounded-lg my-3 bg-white">
            <div class="px-6 py-3">
                Storages
            </div>
            <ActionMessage :on="showMessage">Product create sucess!!</ActionMessage>
            <button @click="showModal = true"
                class="m-1 block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">
                Create Product
            </button>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Product name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Color
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Category
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Price
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Qty
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="product in products" :key="product.id"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                     {{ product.product_name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ product.product_color }}
                        </td>
                        <td class="px-6 py-4">
                            {{ product.category.title }}
                        </td>
                        <td class="px-6 py-4">
                            {{ product.product_price }} Baht
                        </td>
                        <td class="px-6 py-4">
                            {{ product.product_qty }}
                        </td>
                        <td class="px-6 py-4">
                            <a href="#"
                                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Edit</a>
                            <button type="button"
                                class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</button>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
        <Modal :show="showModal" @close="handleClose" maxWidth="lg" closeable>
            <template #default>
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Create Product
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
                            <label for="product"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                                Name</label>
                            <input type="text" name="pname" id="pname" v-model="form.pname"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="Product Name" required />
                        </div>
                        <div>
                            <label for="product"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select a
                                Category</label>
                            <select id="countries" v-model="form.cid"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>Choose a category</option>
                                <option v-for="category in categories" :key="category.id" :value="category.id">{{ category.title }}</option>
                            </select>
                        </div>
                        <div>
                            <label for="product"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                                Color</label>
                            <input type="text" name="pcolor" id="pcolor" v-model="form.pcolor"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="Product Color" required />
                        </div>
                        <div>
                            <label for="product"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                                Price</label>
                            <input type="number" name="pprice" id="pprice" v-model="form.pprice"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="Product Price" required />
                        </div>
                        <label for="quantity-input"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Choose
                            quantity:</label>
                        <div class="relative flex items-center max-w-[8rem]">

                            <input type="number" id="quantity-input" data-input-counter v-model="form.pqty" min="0"
                                aria-describedby="helper-text-explanation"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="Quantity" required />

                        </div>
                        <div class="flex items-center justify-center w-full">
                            <label for="dropzone-file"
                                class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-gray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                            class="font-semibold">Click to
                                            upload</span> or drag and drop</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX.
                                        800x400px)</p>
                                </div>
                                <input id="dropzone-file" type="file" class="hidden" name="dropzone-file"
                                    @input="form.pimage = $event.target.files[0]" />
                            </label>
                        </div>
                        <button type="submit" :disabled="form.processing"
                            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create
                            Product</button>
                    </form>
                </div>
            </template>
        </Modal>
    </AppLayout>
</template>
