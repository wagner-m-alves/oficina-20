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

                    <!-- Listing -->
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
                                    <button class="text-sm text-red-600 hover:text-red-900" @click.prevent="wantDestroy(employee.id)">Deletar</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- End Listing -->


                    <!-- Modals -->
                    <jet-confirmation-modal :show="showModal" @close="cancel">
                        <template #title>
                            Deletar Registro
                        </template>

                        <template #content>
                            Você está prestes a deletar um registro e isso não poderá ser desfeito. Deseja continuar?
                        </template>

                        <template #footer>
                            <jet-button type="button" @click="cancel">
                                Cancelar
                            </jet-button>

                            <jet-danger-button class="mx-4" @click="destroy">
                                Deletar
                            </jet-danger-button>
                        </template>
                    </jet-confirmation-modal>
                    <!-- End Modals -->
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { Link } from '@inertiajs/inertia-vue3';
    import SuccessNotification from '@/Components/Notifications/SuccessNotification'
    import FailedNotification from '@/Components/Notifications/FailedNotification'
    import JetConfirmationModal from '@/Jetstream/ConfirmationModal.vue'
    import JetDangerButton from '@/Jetstream/DangerButton.vue'
    import JetButton from '@/Jetstream/Button.vue'

    export default defineComponent({
        components: {
            AppLayout,
            Link,
            SuccessNotification,
            FailedNotification,
            JetConfirmationModal,
            JetDangerButton,
            JetButton,
        },

        data () {
            return {
                showModal:  false,
                deleteId:   ''
            }
        },

        methods: {
            wantDestroy(id) {
                this.showModal  = true
                this.deleteId   = id
            },

            destroy () {
                this.showModal = false

                if(this.deleteId){
                    this.$inertia.delete(this.route('employees.destroy', this.deleteId))
                }

                this.deleteId = ''
            },

            cancel () {
                this.showModal  = false
                this.deleteId   = ''
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
