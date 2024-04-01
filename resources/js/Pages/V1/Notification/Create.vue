<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';
import Inertia from '@inertiajs/inertia';
import Category from '@/src/Category/Structure/Category';
import { Link } from '@inertiajs/vue3';
import axios from 'axios';
import Swal from 'sweetalert2'

let props = defineProps({
    categoryCollection: Object,
    typeCollection: Object
});

let errors = ref({});

const categories = ref(props.categoryCollection.map(category => new Category(category)));
const types = ref(props.typeCollection);

const form = useForm({
    category: '',
    content: '',
    type: ''
});

const typeText = (typeNotification) => {
    switch (typeNotification) {
        case 'sms':
            return 'SMS';
        case 'push_notification':
            return 'Notificación push';
        case 'email':
            return 'Correo electrónico';
        default:
            return 'Desconocido';
    }
};

const submit = () => {
    axios.post(route('notification.store'), form.data())
        .then(() => {
            Swal.fire({
                title: "Hecho",
                text: "Notificación registrada correctamente",
                icon: "success",
            }).then(() => {
                window.location.href = route('notification.index');
                // Bug en libreria, no redirecciona por error en el componente
                //Inertia.visit(route('notification.index'));
            });
        })
        .catch(error => {
            errors.value = error.response.data.errors;
        });
};

</script>

<template>
    <Head title="Crear notification" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Registrar notificación</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <form @submit.prevent="submit">
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <label for="category" class="block text-sm font-medium text-gray-700">Categoría</label>
                                    <select v-model="form.category" id="category" name="category" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        <option value="">Selecciona una categoría</option>
                                        <option v-for="category in categories" :value="category.id" :key="category.id">{{ category.name }}</option>
                                    </select>
                                    <div class="text-sm text-red-500 font-bold mt-1" v-if="errors.category">
                                        {{ errors.category.join(', ') }}
                                    </div>
                                </div>

                                <div>
                                    <label for="category" class="block text-sm font-medium text-gray-700">Tipo</label>
                                    <select v-model="form.type" id="type" name="type" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        <option value="">Selecciona un tipo de notificación</option>
                                        <option v-for="typeNotification in types" :value="typeNotification" :key="typeNotification">{{ typeText(typeNotification) }}</option>
                                    </select>
                                    <div class="text-sm text-red-500 font-bold mt-1" v-if="errors.type">
                                        {{ errors.type.join(', ') }}
                                    </div>
                                </div>

                                <div>
                                    <label for="content" class="block text-sm font-medium text-gray-700">Contenido</label>
                                    <textarea v-model="form.content" id="content" name="content" rows="3" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>

                                    <div class="text-sm text-red-500 font-bold mt-1" v-if="errors.content">
                                        {{ errors.content.join(', ') }}
                                    </div>
                                </div>
                            </div>
                            <div class="flex space-x-2 justify-end">
                                <button type="submit" class="mt-4 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Guardar
                                </button>
                                <Link :href="route('notification.index')" class="mt-4 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-gray-600 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                                    Cancelar
                                </Link>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
