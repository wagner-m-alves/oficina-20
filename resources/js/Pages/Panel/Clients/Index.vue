<template>
    <app-layout title="Clientes">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Clientes
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <success-notification></success-notification>
                    <failed-notification></failed-notification>


                    <!-- Actions -->
                    <primary-button class="mb-4" @click="create">Novo</primary-button>
                    <!-- Actions -->


                    <!-- Listing -->
                    <p><strong>Total: </strong>{{clients.meta.total}}</p>

                    <table class="w-full divide-y divide-gray-700">
                        <thead class="bg-gray-700 text-white uppercase">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider">Nome</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider">Contato</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider">Email</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-700 text-center">
                            <tr v-for="(client, index) in clients.data" :key="index">
                                <td class="px-6 py-2 text-sm font-medium whitespace-nowrap tracking-wider">{{client.name}}</td>
                                <td class="px-6 py-2 text-sm font-medium whitespace-nowrap tracking-wider">{{client.contact}}</td>
                                <td class="px-6 py-2 text-sm font-medium whitespace-nowrap tracking-wider">{{client.email ? client.email : '-'}}</td>
                                <td class="px-6 py-2 text-sm font-medium whitespace-nowrap tracking-wider">
                                    <success-button class="mr-3" @click="edit(client.id)">Editar</success-button>
                                    <jet-danger-button @click="wantDestroy(client.id)">Deletar</jet-danger-button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <div class="mt-4">
                                <Pagination
                                    :pagination="clients.meta"
                                    @paginate="changePage">
                                </Pagination>
                            </div>
                        </tfoot>
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
                            <light-button @click="cancel">
                                Cancelar
                            </light-button>

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
    import JetConfirmationModal from '@/Jetstream/ConfirmationModal.vue'
    import JetDangerButton from '@/Jetstream/DangerButton.vue'
    import JetButton from '@/Jetstream/Button.vue'
    import SuccessNotification from '@/Components/Notifications/SuccessNotification.vue'
    import FailedNotification from '@/Components/Notifications/FailedNotification.vue'
    import Pagination from '@/Components/Pagination.vue'
    import SuccessButton from '@/Components/Buttons/SuccessButton.vue'
    import LightButton from '@/Components/Buttons/LightButton.vue'
    import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue'

    export default defineComponent({
        components: {
            AppLayout,
            JetConfirmationModal,
            JetDangerButton,
            JetButton,
            SuccessNotification,
            FailedNotification,
            Pagination,
            SuccessButton,
            LightButton,
            PrimaryButton,
        },

        data () {
            return {
                showModal:  false,
                deleteId:   '',
            }
        },

        methods: {
            wantDestroy(id) {
                this.showModal  = true
                this.deleteId   = id
            },

            create () {
                this.$inertia.get(this.route('clients.create'))
            },

            edit (id) {
                this.$inertia.get(this.route('clients.edit', id))
            },

            destroy () {
                this.showModal = false

                if(this.deleteId){
                    this.$inertia.delete(this.route('clients.destroy', this.deleteId))
                }

                this.deleteId = ''
            },

            cancel () {
                this.showModal  = false
                this.deleteId   = ''
            },

            changePage (page) {
                var url = window.location.pathname + `?page=${page}`

                this.$inertia.get(url)
            }
        },

        props: {
            'clients': {
                required:   true,
                type:       Object,
            }
        },
    })
</script>
