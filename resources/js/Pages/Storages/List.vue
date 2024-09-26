<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Modal from '@/Components/Modal.vue';
import { useForm } from '@inertiajs/vue3';
import { reactive, ref } from 'vue'
import { router } from '@inertiajs/vue3'
import ActionMessage from '@/Components/ActionMessage.vue';

const form = useForm({
    pname: '',
    pcolor: '',
    pprice: '',
    pimage: '',
    pqty: '',
    cid: '',
});

const formedit = useForm({
    id: null,
    peditname: '',
    peditcolor: '',
    peditprice: '',
    peditimage: '',
    peditqty: '',
    ceditid: '',
});
const showMessage = ref(false);

const successMessage = ref('');

function ProductCreatesubmit() {
    router.post(route('storages.store'), form, {
        onSuccess: () => {
            successMessage.value = 'Product created successfully!';
            showMessage.value = true;
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
const openEditModal = (product) => {
    formedit.id = product.id;
    formedit.peditname = product.product_name;
    formedit.peditcolor = product.product_color;
    formedit.peditprice = product.product_price;
    formedit.peditimage = product.product_image;
    formedit.peditqty = product.product_qty;
    formedit.ceditid = product.category_id;
    showProductEditModal.value = true;
};

function ProductEditsubmit() {
    router.patch(route('storages.update', formedit.id), formedit, {
        onSuccess: () => {
            successMessage.value = 'Product update successfully!';
            showMessage.value = true;
            handleClose();
            handleSubmit();
            formedit.peditname = '';
            formedit.peditcolor = '';
            formedit.peditprice = '';
            formedit.peditimage = '';
            formedit.peditqty = '';
            formedit.ceditid = '';
        },
    });
}
function ProductDelete(productId) {
    router.delete(route('storages.destroy', productId), {
        onSuccess: () => {
            successMessage.value = 'Product deleted successfully!';
            showMessage.value = true;
        },
    });
}
const showProductCreateModal = ref(false);
const showProductEditModal = ref(false);

const handleClose = () => {
    showProductCreateModal.value = false;
    showProductEditModal.value = false;
};

const handleSubmit = () => {
    console.log('Form submitted:');
    setTimeout(() => {
        showMessage.value = false;
    }, 2000);
};

defineProps({ categories: Object, products: Object })


</script>
<template>
    <AppLayout title="Storages">
        <ActionMessage :on="showMessage">
            <div v-if="successMessage" class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <span class="font-medium">{{successMessage}}</span>
            </div>
        </ActionMessage>
        <div
            class="flex justify-between dark:bg-gray-800 dark:text-white text-gray-700 text-3xl sm:rounded-lg my-3 bg-white">
            <div class="px-6 py-3">
                Storages
            </div>
            <button @click="showProductCreateModal = true"
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
                            <button @click="openEditModal(product)"
                                class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
                                type="button">
                                Edit
                            </button>
                            <button type="button" @click="ProductDelete(product.id)"
                                class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                Delete</button>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
        <!--Create Product Modal-->
        <Modal :show="showProductCreateModal" @close="handleClose" maxWidth="lg" closeable>
            <template #default>
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Create Product
                    </h3>
                    <button type="button" @click="showProductCreateModal = false"
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
                    <form @submit.prevent="ProductCreatesubmit" class="space-y-4">
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
                                <option v-for="category in categories" :key="category.id" :value="category.id">{{
                                    category.title }}</option>
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
        <!--Edit Product Modal-->
        <Modal :show="showProductEditModal" @close="handleClose" maxWidth="lg" closeable>
            <template #default>
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Edit Product
                    </h3>
                    <button type="button" @click="showProductEditModal = false"
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
                    <form @submit.prevent="ProductEditsubmit" class="space-y-4">
                        <div>
                            <input type="hidden" v-model="formedit.id" value="{{product.id}}">
                            <label for="product"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                                Name</label>
                            <input type="text" name="pname" id="pname" v-model="formedit.peditname"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="Product Name" required />
                        </div>
                        <div>
                            <label for="product"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select a
                                Category</label>
                            <select id="countries" v-model="formedit.ceditid"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected>Choose a category</option>
                                <option v-for="category in categories" :key="category.id" :value="category.id">{{
                                    category.title }}</option>
                            </select>
                        </div>
                        <div>
                            <label for="product"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                                Color</label>
                            <input type="text" name="pcolor" id="pcolor" v-model="formedit.peditcolor"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="Product Color" required />
                        </div>
                        <div>
                            <label for="product"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product
                                Price</label>
                            <input type="number" name="pprice" id="pprice" v-model="formedit.peditprice"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="Product Price" required />
                        </div>
                        <label for="quantity-input"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Choose
                            quantity:</label>
                        <div class="relative flex items-center max-w-[8rem]">

                            <input type="number" id="quantity-input" data-input-counter v-model="formedit.peditqty"
                                min="0" aria-describedby="helper-text-explanation"
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
                                    @input="formedit.peditimage = $event.target.files[0]" />
                            </label>
                        </div>
                        <button type="submit" :disabled="form.processing"
                            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Update
                            Product</button>
                    </form>
                </div>
            </template>
        </Modal>
    </AppLayout>
</template>
