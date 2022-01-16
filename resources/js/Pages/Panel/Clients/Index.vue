<template>
    <app-layout title="Clientes">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Clientes
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-4">
                        <success-notification></success-notification>
                        <failed-notification></failed-notification>
                    </div>

                    <Link :href="route('clients.create')" class="underline text-sm text-gray-600 hover:text-gray-900">
                        Novo
                    </Link>

                    <table>
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Contato</th>
                                <th>Email</th>
                                <th width="180px">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(client, index) in clients.data" :key="index">
                                <td>{{client.name}}</td>
                                <td>{{client.contact}}</td>
                                <td>{{client.email ? client.email : 'Indisponível'}}</td>
                                <td>
                                    <Link :href="route('clients.edit', client.id)" class="underline text-sm text-gray-600 hover:text-gray-900">Editar</Link>
                                    <a href="#" @click.prevent="">Deletar</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { Link } from '@inertiajs/inertia-vue3';
    import SuccessNotification from '../../../Components/Notifications/SuccessNotification'
    import FailedNotification from '../../../Components/Notifications/FailedNotification'

    export default defineComponent({
        components: {
            AppLayout,
            Link,
            SuccessNotification,
            FailedNotification,
        },

        props: {
            'clients': {
                required:   true,
                type:       Object,
            }
        },
    })
</script>
