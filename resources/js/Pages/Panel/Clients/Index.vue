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
                    <div class="p-4" v-if="$page.props.flash.success">
                        <success-notification>{{ $page.props.flash.success }}</success-notification>
                    </div>

                    <Link :href="route('clients.create')" class="underline text-sm text-gray-600 hover:text-gray-900">
                        Novo
                    </Link>

                    <table>
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Contato</th>
                                <th width="180px">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(client, index) in clients.data" :key="index">
                                <td>{{client.name}}</td>
                                <td>{{client.contact}}</td>
                                <td>
                                    <a href="#" @click.prevent="">Editar</a>
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
    import SuccessNotification from '../../../Components/SuccessNotification'

    export default defineComponent({
        components: {
            AppLayout,
            Link,
            SuccessNotification,
        },

        props: {
            'clients': {
                required:   true,
                type:       Object,
            }
        }
    })
</script>
