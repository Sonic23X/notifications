<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';
import Notification from '@/src/Notification/Structure/Notification';
import { Link } from '@inertiajs/vue3';

let props = defineProps({
    notificationCollection: Object
});

const notifications = ref(props.notificationCollection.data.map(notification => new Notification(notification)));

</script>

<template>
    <Head title="Notification" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Lista de notificaciones</h2>
        </template>

        <div class="py-10">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex flex-row justify-end py-3 px-4">
                        <Link class="px-4 py-2 bg-black text-white rounded-3xl flex flex-row gap-2"
                            :href="route('notification.create')">
                            <span>Nueva notificación</span>
                        </Link>
                    </div>

                    <div class="flex overflow-x-auto justify-center">
                        <table class="w-5/6 text-sm text-left mx-3 my-3 rounded-sm">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Contenido
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        tipo
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Categoria
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="notification in notifications" :key="notification.id" class="border-b">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        {{ notification.content }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ notification.type }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ notification.category.name }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
