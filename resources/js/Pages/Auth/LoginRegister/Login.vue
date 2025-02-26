<script setup>
    import { useForm } from '@inertiajs/vue3'
    import { ref } from 'vue'

    import PrivacyPolicy from '@/Components/PrivacyPolicy.vue'

    defineOptions({
        name: 'Login'
    })

    const form = useForm({
        email: '',
        password: '',
        // remember: false,
    });

    const submit = () => {
        form.post(route('login'), {
            onFinish: () => form.reset('password'),
        });
    };

    const tab = ref('login')
</script>

<template>
    <form @submit.prevent="submit">
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
                        class="full-width q-pa-none"
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
                        class="full-width q-pa-none"
                    />
                </q-item-section>
            </q-item>
            <q-item class="no-border q-mt-sm">
                <q-item-section>
                    <q-btn label="Log in" type="submit" class="text-mutan bg-bluies full-width"/>
                </q-item-section>
            </q-item>
            <q-item class="no-border">
                <q-item-section class="text-gries text-size-10 text-center q-mb-md" style="display: block;">
                    <PrivacyPolicy />
                </q-item-section>
            </q-item>
        </q-list>
    </form>
</template>

<style lang="sass" scoped>
.q-field__control
    color: $gries
    background: $mutan !important
</style>
