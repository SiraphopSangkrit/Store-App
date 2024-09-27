<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Modal from '@/Components/Modal.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';
import ActionMessage from '@/Components/ActionMessage.vue';

const showUserCreateModal = ref(false);

const handleClose = () => {
    showUserCreateModal.value = false;
};
const form = useForm({
    firstname: '',
    middlename: '',
    lastname: '',
    email: '',
    tel: '',
    userimage: '',
});
function UserCreatesubmit() {
    router.post(route('user.store'), form, {
        onSuccess: () => {
            successMessage.value = 'User created successfully!';
            showMessage.value = true;
            handleClose();
            handleSubmit();
        },
    });
}
const inputVisible = ref(false);

const showMiddlenameinput = () => {
    inputVisible.value = false;
}

const handleSubmit = () => {
    console.log('Form submitted:');
    setTimeout(() => {
        showMessage.value = false;
    }, 2000);
};

const showMessage = ref(false);

const successMessage = ref('');
defineProps({ users: Object })


</script>
<template>
    <AppLayout title="Users">
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
                Users
            </div>
            <button @click="showUserCreateModal = true"
                class="m-1 block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">
                Create User
            </button>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            User Picture
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Tel
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Role
                        </th>
                        <th scope="col" class="px-6 py-3 flex justify-center">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users" :key="user.id"
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4">

                        </th>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ user.firstname }} {{ user.middlename }} {{ user.lastname }}
                        </th>
                        <td class="px-6 py-4">
                            {{ user.email }}
                        </td>
                        <td class="px-6 py-4">
                            {{ user.tel }}
                        </td>
                        <td class="px-6 py-4">
                            <span v-for="role in user.roles" :key="role.id">
                                {{ role.name === 'superadmin' ? 'Super Admin' :
                                    role.name === 'admin' ? 'Admin' :
                                        role.name === 'customer' ? 'Customer' :
                                role.name }}
                            </span>
                        </td>
                        <td class="px-6 py-4 flex justify-center">
                            <button type="button"
                                class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                Delete</button>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
        <!--Create User Modal-->
        <Modal :show="showUserCreateModal" @close="handleClose" maxWidth="lg" closeable>
            <template #default>
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Create Product
                    </h3>
                    <button type="button" @click="showUserCreateModal = false"
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
                    <form @submit.prevent="UserCreatesubmit" class="space-y-4">
                        <div>
                            <label for="product"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Firstname</label>
                            <input type="text" name="firstname" id="firstname" v-model="form.firstname"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="Firstname" required />
                        </div>
                        <div class="flex">
                            <input id="default-checkbox" type="checkbox" v-model="inputVisible"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <div class="block mb-2 ml-2 text-sm font-medium text-gray-900 dark:text-white">If you have
                                middlename check this box</div>
                        </div>

                        <div v-if="inputVisible">
                            <label for="product"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Middlename</label>
                            <input type="text" name="middlename" id="middlename" v-model="form.middlename"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="Middlename" />
                        </div>
                        <div>
                            <label for="product"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lastname</label>
                            <input type="text" name="lastname" id="lastname" v-model="form.lastname"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="Lastname" required />
                        </div>
                        <div>
                            <label for="product"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="email" name="email" id="email" v-model="form.email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="Email" required />
                        </div>
                        <div>
                            <label for="product"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tel</label>
                            <input type="text" name="tel" id="tel" v-model="form.tel"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="Tel" required />
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
                                    @input="form.userimage = $event.target.files[0]" />
                            </label>
                        </div>
                        <button type="submit" :disabled="form.processing"
                            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create
                            User</button>
                    </form>
                </div>
            </template>
        </Modal>
    </AppLayout>
</template>
