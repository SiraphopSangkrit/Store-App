<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { ref } from 'vue';

const form = useForm({
    username: '',
    firstname: '',
    middlename: '',
    lastname: '',
    email: '',
    tel: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
const inputVisible = ref(false);

const showMiddlenameinput = () => {
    inputVisible.value = false;
};
</script>

<template>

    <Head title="Register" />

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <form @submit.prevent="submit">

                <div>
                    <InputLabel for="username" value="Username" />
                    <TextInput id="username" v-model="form.username" type="text" class="mt-1 block w-full" required
                        autofocus autocomplete="username" />
                    <InputError class="mt-2" :message="form.errors.username" />
                </div>
                <div>
                    <InputLabel for="firstname" value="Firstname" />
                    <TextInput id="firstname" v-model="form.firstname" type="text" class="mt-1 block w-full" required
                        autofocus autocomplete="firstname" />
                    <InputError class="mt-2" :message="form.errors.firstname" />
                </div>
                <div class="flex mt-4">
                    <input id="default-checkbox" type="checkbox" v-model="inputVisible"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <div class="block mb-2 ml-2 text-sm font-medium text-gray-900 dark:text-white">If you have
                        middlename check this box</div>
                </div>
                <div v-if="inputVisible">

                    <InputLabel for="middlename" value="Middlename" />
                    <TextInput id="middlename" v-model="form.middlename" type="text" class="mt-1 block w-full" autofocus
                        autocomplete="middlename" />
                    <InputError class="mt-2" :message="form.errors.middlename" />
                </div>
                <div>
                    <InputLabel for="lastname" value="Lastname" />
                    <TextInput id="lastname" v-model="form.lastname" type="text" class="mt-1 block w-full" required
                        autofocus autocomplete="lastname" />
                    <InputError class="mt-2" :message="form.errors.lastname" />
                </div>
                <div class="mt-4">
                    <InputLabel for="email" value="Email" />
                    <TextInput id="email" v-model="form.email" type="email" class="mt-1 block w-full" required
                        autocomplete="email" />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>
                <div class="mt-4">
                    <InputLabel for="tel" value="Tel" />
                    <TextInput id="text" v-model="form.tel" type="email" class="mt-1 block w-full" autocomplete="tel" />
                    <InputError class="mt-2" :message="form.errors.tel" />
                </div>
                <div class="mt-4">
                    <InputLabel for="password" value="Password" />
                    <TextInput id="password" v-model="form.password" type="password" class="mt-1 block w-full" required
                        autocomplete="new-password" />
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="mt-4">
                    <InputLabel for="password_confirmation" value="Confirm Password" />
                    <TextInput id="password_confirmation" v-model="form.password_confirmation" type="password"
                        class="mt-1 block w-full" required autocomplete="new-password" />
                    <InputError class="mt-2" :message="form.errors.password_confirmation" />
                </div>

                <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature" class="mt-4">
                    <InputLabel for="terms">
                        <div class="flex items-center">
                            <Checkbox id="terms" v-model:checked="form.terms" name="terms" required />

                            <div class="ms-2">
                                I agree to the <a target="_blank" :href="route('terms.show')"
                                    class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">Terms
                                    of Service</a> and <a target="_blank" :href="route('policy.show')"
                                    class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">Privacy
                                    Policy</a>
                            </div>
                        </div>
                        <InputError class="mt-2" :message="form.errors.terms" />
                    </InputLabel>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <Link :href="route('login')"
                        class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                    Already registered?
                    </Link>

                    <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Register
                    </PrimaryButton>
                </div>

        </form>
    </AuthenticationCard>
</template>
