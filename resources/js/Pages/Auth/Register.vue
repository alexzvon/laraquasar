<script setup>
    import { useForm, Head, Link } from '@inertiajs/vue3'
    import { ref } from 'vue'

    import GuestLayout from '@/Layouts/GuestLayout.vue'
    import PrivacyPolicy from '@/Components/PrivacyPolicy.vue'

    defineOptions({
        name: 'Register'
    })

    const form = useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
    });

    const submit = () => {
        form.post(route('auth.register'), {
            onFinish: () => form.reset(['password', 'password_confirmation']),
        });
    };

    const tab = ref('login')
</script>

<template>
    <GuestLayout>
        <Head title="Register" />
        <template #title>Зарегистрироваться</template>
        <form @submit.prevent="submit">
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
                <q-item class="no-border q-mt-sm">
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
                <q-item class="no-border q-mt-sm">
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
                <q-item class="no-border q-mt-sm">
                    <q-item-section>
                        <q-btn label="Зарегистрироваться" type="submit" class="text-mutan bg-bluies full-width"/>
                    </q-item-section>
                </q-item>
                <q-item class="no-border">
                    <q-item-section class="text-gries text-size-10 text-center q-mb-md block">
                        <PrivacyPolicy />
                    </q-item-section>
                </q-item>
            </q-list>
        </form>
    </GuestLayout>
</template>

<style lang="sass" scoped>
.q-field__control
    color: $gries
    background: $mutan !important
</style>

<style lang="sass">
.q-error-pt-none .q-field__bottom
    padding-top: 0px
</style>
