<template>
    <app-layout title="Cadastrar Orçamento">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Cadastrar Orçamento
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <jet-validation-errors class="mb-4" />


                    <!-- Notifications -->
                    <success-notification :flashSuccess="flashSuccess">{{ flashSuccess }}</success-notification>
                    <failed-notification :flashFailed="flashFailed">{{ flashFailed }}</failed-notification>
                    <!-- End Notifications -->


                    <!-- New Estimate Form -->
                    <form @submit.prevent="createEstimate" class="p-6">
                        <div>
                            <jet-label for="client_id" value="Cliente" />
                            <select id="client_id" v-model="formEstimate.client_id" required>
                                <option value="">Selecione</option>
                                <option v-for="(client, index) in clients.data" :key="index" :value="client.id">{{client.name}}</option>
                            </select>

                            <!-- Add Client -->
                            <primary-button class="mx-4" type="button" @click="showModal = true">Novo</primary-button>
                            <!-- End Add Client -->
                        </div>

                        <div class="mt-4">
                            <jet-label for="description" value="Descrição" />
                            <textarea id="description" cols="118" rows="5" v-model="formEstimate.description" required></textarea>
                        </div>

                        <div class="mt-4">
                            <jet-label for="value" value="Valor" />
                            <jet-input id="value" type="text" class="mt-1 block w-full" v-model="formEstimate.value" required/>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <jet-button class="ml-4" :class="{ 'opacity-25': formEstimate.processing }" :disabled="formEstimate.processing">
                                Salvar
                            </jet-button>
                        </div>
                    </form>
                    <!-- End New Estimate Form -->


                    <!-- New Client Modal -->
                    <jet-dialog-modal :show="showModal" @close="end">
                        <template #title>
                            Adicionar Cliente
                        </template>

                        <template #content>
                            <jet-validation-errors class="mb-4" />

                            <form @submit.prevent="AddClient" class="p-6">
                                <div>
                                    <jet-label for="name" value="Name" />
                                    <jet-input id="name" type="text" class="mt-1 block w-full" v-model="formAddClient.name" required autofocus />
                                </div>

                                <div class="mt-4">
                                    <jet-label for="contact" value="Contato" />
                                    <jet-input id="contact" type="text" class="mt-1 block w-full" v-model="formAddClient.contact" required autofocus />
                                </div>

                                <div class="mt-4">
                                    <jet-label for="email" value="Email" />
                                    <jet-input id="email" type="email" class="mt-1 block w-full" v-model="formAddClient.email"/>
                                </div>

                                <div class="flex items-center justify-end mt-6">
                                    <light-button class="ml-4" @click="end">
                                        Cancelar
                                    </light-button>

                                    <jet-button class="ml-4">
                                        Salvar
                                    </jet-button>
                                </div>
                            </form>
                        </template>
                    </jet-dialog-modal>
                    <!-- End New Client Modal -->
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import JetButton from '@/Jetstream/Button.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetLabel from '@/Jetstream/Label.vue'
    import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'
    import JetDialogModal from '@/Jetstream/DialogModal.vue'
    import JetDangerButton from '@/Jetstream/DangerButton.vue'
    import SuccessNotification from '@/Components/Notifications/SuccessNotification.vue'
    import FailedNotification from '@/Components/Notifications/FailedNotification.vue'
    import LightButton from '@/Components/Buttons/LightButton.vue'
    import PrimaryButton from '@/Components/Buttons/PrimaryButton.vue'

    export default defineComponent({
        components: {
            AppLayout,
            JetButton,
            JetInput,
            JetLabel,
            JetValidationErrors,
            JetDialogModal,
            JetDangerButton,
            SuccessNotification,
            FailedNotification,
            LightButton,
            PrimaryButton,
        },

        created () {
            this.flashSuccess   = this.$page.props.flash.success
            this.flashFailed    = this.$page.props.flash.failed
        },

        data() {
            return {
                flashSuccess:   '',
                flashFailed:    '',

                formEstimate: this.$inertia.form({
                    client_id:      '',
                    description:    '',
                    value:          '',
                }),

                formAddClient: this.$inertia.form({
                    name:       '',
                    contact:    '',
                    email:      '',
                }),

                showModal:  false,
            }
        },

        props: {
            clients: {
                required: true,
            },
        },

        methods: {
            createEstimate() {
                this.formEstimate.post(this.route('estimates.store'));
            },

            AddClient() {
                this.formAddClient.post(this.route('clients.add'), {
                    onSuccess: () => {
                        this.flashSuccess   = this.$page.props.flash.success
                        this.flashFailed    = this.$page.props.flash.failed
                    },
                });

                this.end()
            },

            end () {
                this.showModal = false,

                this.formAddClient = this.$inertia.form({
                    name:       '',
                    contact:    '',
                    email:      '',
                })
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
