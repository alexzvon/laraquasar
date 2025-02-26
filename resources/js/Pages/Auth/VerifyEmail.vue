<script setup>
import { computed } from 'vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
//import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    status: {
        type: String,
    },
});

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(
    () => props.status === 'verification-link-sent',
);

</script>

<template>
    <GuestLayout>
        <Head title="Email Verification" />
        <template #title>Подтвердить email</template>
        <q-list dense>
            <q-item dense>
                <q-item-section dense class="text-gries text-size-10">
Спасибо за регистрацию! Прежде чем начать, не могли бы вы подтвердить свой адрес электронной почты, нажав на ссылку, которую мы только что отправили вам
по электронной почте? Если вы не получили письмо, мы с радостью отправим вам другое.
                </q-item-section>
            </q-item>
            <q-item dense v-if="verificationLinkSent" class="text-negative text-size-10">
                <q-item-section dense>
Новая ссылка для подтверждения была отправлена ​​на адрес электронной почты, который вы указали при регистрации.
                </q-item-section>
            </q-item>
            <q-item class="no-border q-mt-sm">
                <q-item-section>
                    <form @submit.prevent="submit">
                        <q-btn label="Отправить письмо" type="submit" class="text-mutan bg-bluies full-width" no-caps/>
                    </form>
                </q-item-section>
            </q-item>
            <q-item class="no-border q-mt-sm q-mb-lg">
                <q-item-section>
                    <q-btn :href="route('auth.logout')" label="Log Out" class="text-mutan bg-bluies full-width" no-caps/>
                </q-item-section>
            </q-item>
        </q-list>
    </GuestLayout>
</template>
