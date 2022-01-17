<template>
    <app-layout title="Editar Orçamento">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Editar Orçamento
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <jet-validation-errors class="mb-4" />

                    <form @submit.prevent="submit" class="p-6">
                        <div>
                            <jet-label for="client_id" value="Cliente" />
                            <select id="client_id" v-model="estimate.client_id" required>
                                <option value="">Selecione</option>
                                <option v-for="(client, index) in clients.data" :key="index" :value="client.id">{{client.name}}</option>
                            </select>
                        </div>

                        <div class="mt-4">
                            <jet-label for="description" value="Descrição" />
                            <textarea id="description" cols="118" rows="5" v-model="estimate.description" required></textarea>
                        </div>

                        <div class="mt-4">
                            <jet-label for="value" value="Valor" />
                            <jet-input id="value" type="text" class="mt-1 block w-full" v-model="estimate.value" required/>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <jet-button class="ml-4">
                                Salvar
                            </jet-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue'
    import JetButton from '@/Jetstream/Button.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetCheckbox from '@/Jetstream/Checkbox.vue'
    import JetLabel from '@/Jetstream/Label.vue'
    import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'

    export default defineComponent({
        components: {
            AppLayout,
            JetAuthenticationCard,
            JetButton,
            JetInput,
            JetCheckbox,
            JetLabel,
            JetValidationErrors,
        },

        props: {
            estimate: {
                required: true,
            },
            clients: {
                required: true,
            },
        },

        methods: {
            submit() {
                this.$inertia.put(this.route('estimates.update', this.estimate.id), this.estimate);
            }
        }
    })
</script>
