<template>
    <app-layout title="Orçamentos">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Orçamentos
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <!-- Notifications -->
                    <success-notification :flashSuccess="flashSuccess">{{ flashSuccess }}</success-notification>
                    <failed-notification :flashFailed="flashFailed">{{ flashFailed }}</failed-notification>
                    <!-- End Notifications -->


                    <!-- Actions -->
                    <primary-button class="mb-4" @click="create">Novo</primary-button>
                    <!-- Actions -->


                    <!-- Search Form -->
                    <form @submit.prevent="search">
                        <div class="mt-4 inline">
                            <jet-input id="client" type="text" class="mr-2" v-model="formSearch.client" placeholder="Cliente"/>

                            <jet-input id="employee" type="text" class="mr-2" v-model="formSearch.employee" placeholder="Vendedor"/>

                            <jet-input class="mr-2" type="date" name="dtInitial" v-model="formSearch.dtInitial"/>

                            <jet-input class="mr-2" type="date" name="dtFinal" v-model="formSearch.dtFinal"/>

                            <jet-button>Buscar</jet-button>
                        </div>

                        <div class="mt-4">

                        </div>

                        <div class="flex items-center justify-end mt-4">

                        </div>
                    </form>
                    <!-- End Search Form -->


                    <!-- Listing -->
                    <p><strong>Total: </strong>{{estimates.meta.total}}</p>

                    <table class="w-full divide-y divide-gray-700">
                        <thead class="bg-gray-700 text-white uppercase">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider">Data</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider">Cliente</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider">Vendedor</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider">Valor</th>
                                <th class="px-6 py-3 text-xs font-medium tracking-wider">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-700 text-center">
                            <tr v-for="(estimate, index) in estimates.data" :key="index">
                                <td class="px-6 py-2 text-sm font-medium whitespace-nowrap tracking-wider">{{estimate.datetime}}</td>
                                <td class="px-6 py-2 text-sm font-medium whitespace-nowrap tracking-wider">{{estimate.client.name}}</td>
                                <td class="px-6 py-2 text-sm font-medium whitespace-nowrap tracking-wider">{{estimate.employee.name}}</td>
                                <td class="px-6 py-2 text-sm font-medium whitespace-nowrap tracking-wider">R$ {{ estimate.value }}</td>
                                <td class="px-6 py-2 text-sm font-medium whitespace-nowrap tracking-wider">
                                    <success-button class="mr-3" @click="edit(estimate.id)">Editar</success-button>
                                    <jet-danger-button @click="wantDestroy(estimate.id)">Deletar</jet-danger-button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <div class="mt-4">
                                <Pagination
                                    :pagination="estimates.meta"
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
    import JetInput from '@/Jetstream/Input.vue'
    import JetLabel from '@/Jetstream/Label.vue'
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
            JetInput,
            JetLabel,
            SuccessNotification,
            FailedNotification,
            Pagination,
            SuccessButton,
            LightButton,
            PrimaryButton,
        },

        created () {
            this.flashSuccess   = this.$page.props.flash.success
            this.flashFailed    = this.$page.props.flash.failed
        },

        data () {
            return {
                showModal:      false,
                deleteId:       '',
                flashSuccess:   '',
                flashFailed:    '',

                formSearch: this.$inertia.form({
                    client:      '',
                    employee:    '',
                    dtInitial:   '',
                    dtFinal:     '',
                }),
            }
        },

        methods: {
            wantDestroy(id) {
                this.showModal  = true
                this.deleteId   = id
            },

            create () {
                this.$inertia.get(this.route('estimates.create'))
            },

            edit (id) {
                this.$inertia.get(this.route('estimates.edit', id))
            },

            destroy () {
                this.showModal = false

                if(this.deleteId){
                    this.$inertia.delete(this.route('estimates.destroy', this.deleteId), {
                        onSuccess: () => {
                            this.flashSuccess   = this.$page.props.flash.success
                            this.flashFailed    = this.$page.props.flash.failed
                        },
                    })
                }

                this.deleteId = ''
            },

            cancel () {
                this.showModal  = false
                this.deleteId   = ''
            },

            search () {
                this.formSearch.post(this.route('estimates.search'));
            },

            changePage (page) {
                var url = window.location.pathname + `?page=${page}`

                this.$inertia.get(url)
            }
        },

        props: {
            'estimates': {
                required:   true,
                type:       Object,
            }
        },

        watch: {
            flashSuccess: function (value) {
                var vm = this

                 setTimeout(() => {
                    vm.flashSuccess = ''
                 }, 3000);
            },

            flashFailed: function (value) {
                var vm = this

                 setTimeout(() => {
                    vm.flashFailed = ''
                 }, 3000);
            }
        },
    })
</script>
