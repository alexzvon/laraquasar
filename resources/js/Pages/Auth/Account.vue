<script setup>
    import { Head, Link, useForm } from '@inertiajs/vue3'
    // import { ref } from 'vue'
    import GuestLayout from '@/Layouts/GuestLayout.vue'

    defineOptions({
        name: 'Account'
    })

    const form = useForm({
        name,
        role,

    })

    


</script>

<template>
    <GuestLayout>
        <Head title="Account" />
        <template #title>Аккаунт</template>
        <q-list bordered separator>
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
                        />
                    </q-item-section>
                </q-item>
                <q-item class="no-border q-mt-sm">
                    <q-item-section>
                        <q-btn label="Войти" type="submit" class="text-mutan bg-bluies full-width" no-caps/>
                    </q-item-section>
                </q-item>
                <q-item class="no-border q-mt-sm">
                    <q-item-section>
                        <Link :href="route('auth.ффф')">
                            <q-btn flat label="Изменить" class="text-gries bg-btn-none full-width" no-caps/>
                        </Link>
                    </q-item-section>
                </q-item>
                <q-item class="no-border">
                    <q-item-section class="text-gries text-size-10 text-center q-mb-md" style="display: block;">
                        <PrivacyPolicy />
                    </q-item-section>
                </q-item>
            </q-list>
        <!--<p>{{  $page.props.auth }}</p>-->
    </GuestLayout>
</template>

