<script setup>
    import { useForm, router } from '@inertiajs/vue3'
    import DashboardLayout from '@/Layouts/DashboardLayout.vue'

    defineOptions({
        name: 'CreateUser'
    })

    const form = useForm({
        name: null,
        email: null,
        password: null,
        password_confirmation: null,
    })

    const onSubmit = () => {
        form.post(route('dashboard.users.store'))
    }

    const onReset = () => {
        form.name = null
        form.email = null
        form.password = null
        form.password_confirmation = null
    }

</script>

<template>
    <dashboard-layout>
        <div class="row text-gries bg-mutan q-ma-xl">
            <div class="offset-3 col-6 text-center">
                <q-form @submit.stop.prevent="onSubmit" @reset="onReset">
                    <q-list bordered separator>
                        <q-item class="no-border q-mt-md">
                            <q-item-section>
                                <q-input
                                    filled
                                    v-model="form.name"
                                    label="Введите имя"
                                    dense
                                    label-color="gries"
                                    color="gries"
                                    :error-message="form.errors.name"
                                    :error="!!form.errors.name"
                                    no-error-icon
                                    class="full-width q-pa-none q-error-pt-none"
                                />
                            </q-item-section>
                        </q-item>
                        <q-item class="no-border q-mt-md">
                            <q-item-section>
                                <q-input
                                    filled
                                    v-model="form.email"
                                    label="Введите почту"
                                    dense
                                    label-color="gries"
                                    color="gries"
                                    :error-message="form.errors.email"
                                    :error="!!form.errors.email"
                                    no-error-icon
                                    class="full-width q-pa-none q-error-pt-none"
                                    autocomplete="off"
                                />
                            </q-item-section>
                        </q-item>
                        <q-item class="no-border q-mt-md">
                            <q-item-section>
                                <q-input
                                    filled
                                    type="password"
                                    v-model="form.password"
                                    label="Введите пароль"
                                    dense
                                    label-color="gries"
                                    color="gries"
                                    :error-message="form.errors.password"
                                    :error="!!form.errors.password"
                                    no-error-icon
                                    class="full-width q-pa-none q-error-pt-none"
                                    autocomplete="new-password"
                                />
                            </q-item-section>
                        </q-item>
                        <q-item class="no-border q-mt-md">
                            <q-item-section>
                                <q-input
                                    filled
                                    type="password"
                                    v-model="form.password_confirmation"
                                    label="Еще раз пароль"
                                    dense
                                    label-color="gries"
                                    color="gries"
                                    :error-message="form.errors.password_confirmation"
                                    :error="!!form.errors.password_confirmation"
                                    no-error-icon
                                    class="full-width q-pa-none q-error-pt-none"
                                    autocomplete="new-password"
                                />
                            </q-item-section>
                        </q-item>
                        <q-item class="no-border q-mt-sm text-center">
                            <q-item-section>
                                <q-btn label="Сохранить" type="submit" class="text-mutan bg-bluies" no-caps/>
                            </q-item-section>
                            <q-item-section>
                                <q-btn label="Сбросить" type="reset" flat class="q-ml-md text-bluies" no-caps />
                            </q-item-section>
                            <q-item-section>
                                <q-btn label="Список" class="text-mutan bg-dbrem" no-caps @click="router.visit(route('dashboard.users.index'), { method: 'get'})"/>
                            </q-item-section>
                        </q-item>
                    </q-list>
                </q-form>
            </div>
        </div>
    </dashboard-layout>
</template>

<style lang="sass">
.q-error-pt-none .q-field__bottom
    padding-top: 0px
</style>
