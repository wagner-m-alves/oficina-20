<template>
    <app-layout title="Editar Funcionário">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Editar Funcionário
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <jet-validation-errors class="mb-4" />

                    <form @submit.prevent="submit" class="p-6">
                        <div>
                            <jet-label for="name" value="Name" />
                            <jet-input id="name" type="text" class="mt-1 block w-full" v-model="employee.name" required autofocus autocomplete="name" />
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
            employee: {
                required: true,
            }
        },

        methods: {
            submit() {
                this.$inertia.put(this.route('employees.update', this.employee.id), this.employee);
            }
        }
    })
</script>
