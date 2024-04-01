<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import Log from '@/src/Notification/Structure/Log';

let props = defineProps({
    LogCollection: Object
});

const logs = ref(props.LogCollection.map(log => new Log(log)));

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
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div>
                    <div class="p-6 text-gray-900 text-2xl">Logs de notificaciones enviadas</div>
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
                                <th scope="col" class="px-6 py-3">
                                    Usuario
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Fecha de envio
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="log in logs" :key="log.id" class="border-b">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ log.notification.content }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ typeText(log.notification.type) }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ log.notification.category.name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ log.user.name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ new Date(log.sent_at).toLocaleString() }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
