<template>
    <app-layout title="Funcionários">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Funcionários
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-4">
                        <success-notification></success-notification>
                        <failed-notification></failed-notification>
                    </div>

                    <Link :href="route('employees.create')" class="underline text-sm text-gray-600 hover:text-gray-900">
                        Novo
                    </Link>

                    <table>
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th width="180px">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(employee, index) in employees.data" :key="index">
                                <td>{{employee.name}}</td>
                                <td>
                                    <Link :href="route('employees.edit', employee.id)" class="underline text-sm mx-4 text-green-600 hover:text-green-900">Editar</Link>
                                    <button class="text-sm text-red-600 hover:text-red-900" @click.prevent="destroy(employee.id)">Deletar</button>
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

        methods: {
            destroy (id) {
                this.$inertia.delete(this.route('employees.destroy', id))
            }
        },

        props: {
            'employees': {
                required:   true,
                type:       Object,
            }
        },
    })
</script>
