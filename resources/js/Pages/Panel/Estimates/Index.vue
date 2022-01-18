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
                    <success-notification></success-notification>
                    <failed-notification></failed-notification>

                    <Link :href="route('estimates.create')" class="underline text-sm text-gray-600 hover:text-gray-900">
                        Novo
                    </Link>


                    <!-- Search Form -->
                    <form @submit.prevent="search">
                        <div class="mt-4">
                            <jet-input id="client" type="text" class="mt-1 block w-full" v-model="formSearch.client" placeholder="Cliente"/>
                            <jet-input id="employee" type="text" class="mt-1 block w-full" v-model="formSearch.employee" placeholder="Vendedor"/>
                        </div>

                        <div class="mt-4">
                            <input type="date" name="dtInitial" v-model="formSearch.dtInitial">
                            <input class="mx-4" type="date" name="dtFinal" v-model="formSearch.dtFinal">
                            <jet-button>
                                Buscar
                            </jet-button>
                        </div>

                        <div class="flex items-center justify-end mt-4">

                        </div>
                    </form>
                    <!-- End Search Form -->


                    <!-- Listing -->
                    <table>
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Cliente</th>
                                <th>Vendedor</th>
                                <th>Valor</th>
                                <th width="180px">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(estimate, index) in estimates.data" :key="index">
                                <td>{{estimate.datetime}}</td>
                                <td>{{estimate.client.name}}</td>
                                <td>{{estimate.employee.name}}</td>
                                <td>R$ {{ estimate.value }}</td>
                                <td>
                                    <Link :href="route('estimates.edit', estimate.id)" class="underline text-sm mx-4 text-green-600 hover:text-green-900">Editar</Link>
                                    <button class="text-sm text-red-600 hover:text-red-900" @click.prevent="wantDestroy(estimate.id)">Deletar</button>
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
    import JetInput from '@/Jetstream/Input.vue'
    import JetLabel from '@/Jetstream/Label.vue'

    export default defineComponent({
        components: {
            AppLayout,
            Link,
            SuccessNotification,
            FailedNotification,
            JetConfirmationModal,
            JetDangerButton,
            JetButton,
            JetInput,
            JetLabel,
        },

        data () {
            return {
                showModal:  false,
                deleteId:   '',

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

            destroy () {
                this.showModal = false

                if(this.deleteId){
                    this.$inertia.delete(this.route('estimates.destroy', this.deleteId))
                }

                this.deleteId = ''
            },

            cancel () {
                this.showModal  = false
                this.deleteId   = ''
            },

            search () {
                this.formSearch.post(this.route('estimates.search'));
            }
        },

        props: {
            'estimates': {
                required:   true,
                type:       Object,
            }
        },
    })
</script>
