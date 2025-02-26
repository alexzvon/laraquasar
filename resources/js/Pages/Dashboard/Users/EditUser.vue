<script setup>
    import DashboardLayout from '@/Layouts/DashboardLayout.vue'
    import { useForm, router } from '@inertiajs/vue3'
    import { toRaw } from 'vue'

    defineOptions({
        name: 'EditUser'
    })

    const props = defineProps({
        user: Object
    })

    const user = toRaw(props).user

    const form = useForm({
        id: null,
        name: null,
        email: null,
        email_verified_at: null,
        password: null,
        password_confirmation: null,
        created_at: null,
        updated_at: null,
        _method: 'PUT'
    })

    const onSubmit = () => {
        form.post(route('dashboard.users.update', { 'user': user.id }))
    }

    const onReset = () => {
        form.id = user.id
        form.name = user.name
        form.email = user.email
        form.email_verified_at = user.email_verified_at
        form.password = null
        form.password_confirmation = null
        form.created_at = user.created_at
        form.updated_at = user.updated_at
    }

    onReset()

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
                                    v-model="form.id"
                                    label="Id"
                                    dense
                                    readonly
                                    label-color="gries"
                                    color="gries"
                                    class="full-width q-pa-none q-error-pt-none"
                                />
                            </q-item-section>
                        </q-item>
                        <q-item class="no-border">
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
                        <q-item class="no-border">
                            <q-item-section>
                                <q-input
                                    filled
                                    v-model="form.email"
                                    label="Почта"
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
                        <q-item class="no-border">
                            <q-item-section>
                                <q-input
                                    filled
                                    v-model="form.email_verified_at"
                                    label="Проверка"
                                    dense
                                    readonly
                                    label-color="gries"
                                    color="gries"
                                    :error-message="form.errors.email_verified_at"
                                    :error="!!form.errors.email_verified_at"
                                    no-error-icon
                                    class="full-width q-pa-none q-error-pt-none"
                                    autocomplete="off"
                                />
                            </q-item-section>
                        </q-item>
                        <q-item class="no-border">
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
                        <q-item class="no-border">
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
                        <q-item class="no-border">
                            <q-item-section>
                            <q-input
                                filled
                                dense
                                v-model="form.created_at"
                                label="Создан"
                                label-color="gries"
                                color="gries"
                                readonly
                                class="full-width q-pa-none q-error-pt-none"
                            />
                            </q-item-section>
                        </q-item>
                        <q-item class="no-border">
                            <q-item-section>
                                <q-input
                                    filled
                                    dense
                                    v-model="form.updated_at"
                                    label="Изменен"
                                    label-color="gries"
                                    color="gries"
                                    readonly
                                    class="full-width q-pa-none q-error-pt-none"
                                />
                            </q-item-section>
                        </q-item>
                        <q-item class="no-border q-mb-md text-center">
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

